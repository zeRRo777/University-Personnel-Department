<?php

namespace api\core;

use api\exceptions\MainException;
use api\exceptions\NotFoundException;
use api\helpers\CaseConverter;
use DateTime;
use PDO;
use PDOException;
use ReflectionObject;
use ReflectionProperty;

const ASK  = "ASK";
const DESC = "DESK";

abstract class Model
{
    protected static string $tableName = "";
    protected string $whereQuery = "";
    protected string $orderQuery = "";
    public ?int $id = null;

    private static string $dataErrorMessage = "Ошибка при получении данных";

    public function __set(string $name, mixed $value): void
    {
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $value);
        if ($dateTime !== false) {
            $this->$name = $dateTime;
        }
        $name = CaseConverter::snakeCaseToCamelCase($name);
        $this->$name = $value;
    }

    public function __get(string $name): mixed
    {
        $name = CaseConverter::snakeCaseToCamelCase($name);
        if ($this->$name instanceof DateTime) {
            return $this->$name->format('Y-m-d H:i:s');
        }
        return $this->$name;
    }

    public function __isset(string $name): bool
    {
        $name = CaseConverter::snakeCaseToCamelCase($name);
        return isset($this->$name);
    }

    final public function where(string $name, null|int|float|string|DateTime $value): static
    {
        $value = DB::quote($value);
        if (empty($this->whereQuery)) {
            $this->whereQuery .= "$name=$value";
        } else {
            $this->whereQuery .= " AND $name=$value";
        }
        return $this;
    }

    final public function orderBy(string $orderType): static
    {
        $this->orderQuery = "ORDER BY $orderType";
        return $this;
    }

    final public function get(): array
    {
        try {
            $tableName = static::$tableName;
            $sqlQuery  = "SELECT * from $tableName WHERE $this->whereQuery $this->orderQuery";
            return DB::getPDO()
                ->query($sqlQuery)
                ->fetchAll(PDO::FETCH_CLASS, get_class($this));
        } catch (PDOException $exception)  {
            throw new MainException(self::$dataErrorMessage, $sqlQuery.$exception);
        }
    }

    final public function first(): static
    {
        $models = $this->get();
        if (empty($models)) {
            throw new NotFoundException("", "Запись не найдена");
        }
        return $models[0];
    }

    final public function isEmpty(): bool
    {
        return empty($this->get());
    }

    final public function refresh(): void
    {
        $this->whereQuery = "";
        $this->orderQuery = "";
    }

    final public static function getAll(): array
    {
        try {
            $table = "`".static::$tableName . "`";
            $sqlQuery = "SELECT * from $table";
            return DB::getPDO()
                ->query($sqlQuery)
                ->fetchAll(PDO::FETCH_CLASS, static::class);
        } catch (PDOException) {
            throw new MainException(self::$dataErrorMessage, $sqlQuery);
        }
    }

    final public static function getById(int $id): static
    {
        try {
            $table = "`".static::$tableName . "`";
            $sqlQuery = "SELECT * FROM  $table WHERE id=$id";
            return DB::getPDO()
                ->query($sqlQuery)
                ->fetchObject(static::class);
        } catch (PDOException) {
            throw new MainException(self::$dataErrorMessage, $sqlQuery);
        }
    }

    final public static function getByIdName(int $id, string $id_name): static
    {
        try {
            $table = "`".static::$tableName . "`";
            $sqlQuery = "SELECT * FROM  $table WHERE $id_name=$id";
            return DB::getPDO()
                ->query($sqlQuery)
                ->fetchObject(static::class);
        } catch (PDOException) {
            throw new MainException(self::$dataErrorMessage, $sqlQuery);
        }
    }

    final public function save(): void
    {
        $props          = $this->getPublicProperties();
        if ($this->id === null){
            unset($props['id']);
        }
        $propertyNames  = implode(",", CaseConverter::stringArrayToSnakeCase($props));
        $propertyValues = implode(",", $this->quoteValues($props));
        $tableName      = "`".static::$tableName."`";
        $sqlQuery       = "INSERT INTO $tableName ($propertyNames) VALUES ($propertyValues)";
        try {
            DB::getPDO()
                ->query($sqlQuery)
                ->fetchObject(get_class($this));
            $this->id = (int)DB::getPDO()->lastInsertId();
        } catch (PDOException $exception) {
            throw new MainException(self::$dataErrorMessage, $sqlQuery.$exception);
        }
    }

    final public function update(): void
    {
        $props        = $this->getPublicProperties();
        $updateString = $this->createUpdateString($props);
        $tableName    = "`".static::$tableName."`";
        $sqlQuery     = "UPDATE $tableName SET $updateString WHERE id = $this->id";
        try {
            DB::getPDO()
                ->query($sqlQuery);
        } catch (PDOException) {
            throw new MainException(self::$dataErrorMessage, $sqlQuery);
        }
    }

    final public function delete(): void
    {
        $tableName ="`". static::$tableName."`";
        if (empty($this->orderQuery)) {
            $sqlQuery = "DELETE FROM $tableName WHERE id = $this->id";
        } else {
            $sqlQuery = "DELETE FROM $tableName WHERE $this->orderQuery";
        }
        try {
            DB::getPDO()
                ->query($sqlQuery);
        } catch (PDOException) {
            throw new MainException(self::$dataErrorMessage, $sqlQuery);
        }
    }

    private function getPublicProperties(): array
    {
        $result = [];
        $tmp    = (new ReflectionObject($this))->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($tmp as $prop) {
            $fieldName          = $prop->name;
            if ($this->$fieldName !== null)
            {
                $result[$fieldName] = $this->$fieldName;
            }
        }
        return $result;
    }

    private function quoteValues(array $props): array
    {
        $values = [];
        foreach ($props as $value) {
            $values[] = DB::quote($value);
        }
        return $values;
    }

    private function createUpdateString(array $props): string
    {
        $result = "";
        foreach ($props as $key => $value) {
            $value  = DB::quote($value);
            $key    = CaseConverter::camelCaseToSnakeCase($key);
            $result .= "$key=$value,";
        }
        return substr($result, 0, -1);
    }
}