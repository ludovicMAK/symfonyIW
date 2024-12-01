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
        return "ENUM('movie', 'serie')"; // Déclaration SQL pour le type enum
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value; // Retourne la valeur de l'énumération pour la base de données
    }

    public function getName()
    {
        return self::ENUM;
    }
}
