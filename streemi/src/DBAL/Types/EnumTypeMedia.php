<?php

namespace App\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use App\Enum\MediaTypeStatusEnum;

class EnumTypeMedia extends StringType
{
    const ENUM = 'mediaType'; // Le nom que vous utiliserez pour le type personnalisé

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return MediaTypeStatusEnum::from($value); // Conversion vers l'énumération
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "ENUM('Films', 'Séries')"; // Déclaration SQL pour le type enum
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        // Vérifiez si la valeur est une instance de MediaTypeStatusEnum
        if ($value instanceof MediaTypeStatusEnum) {
            return $value->value;
        }

        // Sinon, retournez directement la valeur si elle est déjà une chaîne
        if (is_string($value)) {
            return $value;
        }

        // Sinon, lancez une exception si la valeur n'est pas valide
        throw new \InvalidArgumentException("Invalid value for MediaType enum: " . gettype($value));
    }


    public function getName()
    {
        return self::ENUM;
    }
}
