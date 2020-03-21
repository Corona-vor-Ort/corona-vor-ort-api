# WirVsVirus - Staatliche Kommunikation

## Requirements

* php 7.2
* composer
* mysql 5.7 or maria db equivalet (10.2?)

## Getting started

Run:

```sh
# install dependencies
composer install
# copy configuration template
cp .env .env.local
```

Change `DATABASE_URL` entry in .env.local to match your system.

```sh
# create database
bin/console doctrine:database:create
# update database structure and seeded data
bin/console doctrine:migrations:migrate
```

## Development

On development be sure to update this README.md to make sure everyone can use your feature correctly.
If it works out of the box?
Great no changes needed

### Make or update entities

The symfony maker bundle helps prototyping data structures.
This is how e.g. the locale tables were introduced.

```
$ bin/console make:entity

 Class name of the entity to create or update (e.g. AgreeablePuppy):
> Locale

 created: src/Entity/Locale.php
 created: src/Repository/LocaleRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > iso

 Field type (enter ? to see all types) [string]:
 > <Enter>

 Field length [255]:
 > <Enter>

 Can this field be null in the database (nullable) (yes/no) [no]:
 > <Enter>

 updated: src/Entity/Locale.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > <Enter>

  Success! 

 Next: When you're ready, create a migration with make:migration
```

Now we have locale entity that has every task related things you need.
After that you add the traits to add the primary key and timestamps that are basic need.
The entity will look like this:

```php
<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocaleRepository")
 */
class Locale
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iso;

    public function getIso(): ?string
    {
        return $this->iso;
    }

    public function setIso(string $iso): self
    {
        $this->iso = $iso;

        return $this;
    }
}
```

The changes in your code get analysed and compared against the database when you execute `bin/console make:migration` to generate a migration.

```
$ bin/console make:migration          

  Success! 

 Next: Review the new migration "src/Migrations/Version20200321100514.php"
 Then: Run the migration with php bin/console doctrine:migrations:migrate
```

Now you can check the generated migration and update your database using `bin/console doctrine:migrations:migrate`
