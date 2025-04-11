<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Projeto Laravel com Doctrine e ACL

Este documento fornece um passo a passo para configurar um projeto Laravel que utiliza o Doctrine ORM e implementa um sistema de autenticação com controle de acesso baseado em funções (ACL).

## 1. Instalação do Laravel

Primeiro, crie um novo projeto Laravel:

```bash
composer create-project --prefer-dist laravel/laravel nome_do_projeto

```

## 2. Instalação do Doctrine ORM
Para integrar o Doctrine ORM ao Laravel, utilize o pacote laravel-doctrine/orm:

```bash
composer require "laravel-doctrine/orm"
```

Após a instalação, publique o arquivo de configuração:

```bash
php artisan vendor:publish --tag="config" --provider="LaravelDoctrine\ORM\DoctrineServiceProvider"
```

## 3. Configuração da Autenticação com Doctrine
No arquivo config/auth.php, configure o driver de autenticação para doctrine e especifique a entidade User:
```bash
'providers' => [
    'users' => [
        'driver' => 'doctrine',
        'model' => App\Entities\User::class,
    ],
],
```
Certifique-se de que a entidade User implemente a interface Illuminate\Contracts\Auth\Authenticatable.




## 4. Implementação de ACL com Laravel Doctrine ACL
Para adicionar funcionalidades de ACL, instale o pacote laravel-doctrine/acl:

```bash
composer require "laravel-doctrine/acl"
```

### 4.1. Criação da Entidade Role
Crie a entidade Role que implementa a interface LaravelDoctrine\ACL\Contracts\Role:

```php
<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\ACL\Contracts\Role as RoleContract;

/**
 * @ORM\Entity()
 */
class Role implements RoleContract
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}
```
Atualize a configuração acl.roles.entity para apontar para a classe App\Entities\Role. ​


### 4.2. Associação da Entidade User com Roles
Na entidade User, implemente a interface LaravelDoctrine\ACL\Contracts\HasRoles e utilize a trait LaravelDoctrine\ACL\Roles\HasRoles:

```php
<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\ACL\Roles\HasRoles;
use LaravelDoctrine\ACL\Contracts\HasRoles as HasRolesContract;

/**
 * @ORM\Entity()
 */
class User implements HasRolesContract
{
    use HasRoles;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entities\Role")
     * @ORM\JoinTable(name="user_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    protected $roles;

    public function getRoles()
    {
        return $this->roles;
    }
}
```
Essa configuração permite associar múltiplas funções a um usuário. ​

### 4.3. Verificação de Permissões
Para verificar se um usuário possui uma determinada função ou permissão, utilize os métodos fornecidos pela trait HasRoles:

```php
if ($user->hasRole('admin')) {
    // O usuário possui a função 'admin'
}

if ($user->hasPermissionTo('editar_post')) {
    // O usuário tem permissão para editar posts
}
```
Esses métodos facilitam o controle de acesso em sua aplicação. ​


## 5. Considerações Finais
Integrar o Doctrine ORM com o Laravel e implementar um sistema de autenticação com ACL proporciona uma estrutura robusta e flexível para gerenciar usuários e permissões em sua aplicação. Certifique-se de ajustar as configurações conforme as necessidades específicas do seu projeto e de proteger adequadamente as rotas e controladores utilizando middleware e políticas de autorização.​

Para mais informações, consulte a documentação oficial do Laravel Doctrine ACL.

Laravel Doctrine [documentation](https://www.laraveldoctrine.org)

Laravel Doctrine ACL [documentation](https://www.laraveldoctrine.org/docs/1.8/acl)

Laravel [documentation](https://laravel.com/docs)


