<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6ec2abf012af9748cb0388b5016a9d77
{
    public static $files = array (
        '658bdf336c9d198311ab5e6434753d27' => __DIR__ . '/../..' . '/App/HMS/Processor/Processor.php',
    );

    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'HMS\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'HMS\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App/HMS',
        ),
    );

    public static $classMap = array (
        'HMS\\Database\\Config' => __DIR__ . '/../..' . '/App/HMS/Database/Config.php',
        'HMS\\Database\\Database' => __DIR__ . '/../..' . '/App/HMS/Database/Database.php',
        'HMS\\Database\\Medoo' => __DIR__ . '/../..' . '/App/HMS/Database/Medoo.php',
        'HMS\\Modules\\Admin\\Admin' => __DIR__ . '/../..' . '/App/HMS/Modules/Admin/Admin.php',
        'HMS\\Modules\\Doctor\\Doctor' => __DIR__ . '/../..' . '/App/HMS/Modules/Doctor/Doctor.php',
        'HMS\\Modules\\Doctor\\Specialist' => __DIR__ . '/../..' . '/App/HMS/Modules/Doctor/Specialist.php',
        'HMS\\Modules\\Patient\\Patient' => __DIR__ . '/../..' . '/App/HMS/Modules/Patient/Patient.php',
        'HMS\\Processor\\Auth' => __DIR__ . '/../..' . '/App/HMS/Processor/Auth.php',
        'HMS\\Processor\\Email' => __DIR__ . '/../..' . '/App/HMS/Processor/Email.php',
        'HMS\\Processor\\Errors' => __DIR__ . '/../..' . '/App/HMS/Processor/Errors.php',
        'HMS\\Processor\\Functions' => __DIR__ . '/../..' . '/App/HMS/Processor/Functions.php',
        'HMS\\Processor\\Input' => __DIR__ . '/../..' . '/App/HMS/Processor/Input.php',
        'HMS\\Processor\\Jasonify' => __DIR__ . '/../..' . '/App/HMS/Processor/Jasonify.php',
        'HMS\\Processor\\Sessions' => __DIR__ . '/../..' . '/App/HMS/Processor/Sessions.php',
        'HMS\\Processor\\Site' => __DIR__ . '/../..' . '/App/HMS/Processor/Site.php',
        'HMS\\Processor\\Time' => __DIR__ . '/../..' . '/App/HMS/Processor/Time.php',
        'HMS\\Processor\\Token' => __DIR__ . '/../..' . '/App/HMS/Processor/Token.php',
        'HMS\\Processor\\User' => __DIR__ . '/../..' . '/App/HMS/Processor/User.php',
        'HMS\\Processor\\Validator' => __DIR__ . '/../..' . '/App/HMS/Processor/Validator.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6ec2abf012af9748cb0388b5016a9d77::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6ec2abf012af9748cb0388b5016a9d77::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6ec2abf012af9748cb0388b5016a9d77::$classMap;

        }, null, ClassLoader::class);
    }
}
