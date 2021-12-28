<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager as FacadesEntityManager;
use Scientist;
use ScientistRepository;
use Symfony\Component\VarDumper\VarDumper;
use Theory;

class ScientistController extends Controller
{
    private $em;
    private $scientists;

    /**
     * 
    */
    public function __construct(ScientistRepository $scientists)
    {
        $this->em = new FacadesEntityManager;

        $this->scientists = $scientists;
    }    

    public function index() {

        // $this->scientists->insert(
        //     [
        //         'firstname' => 'Teste',
        //         'lastname'  => 'de Repository'
        //     ]
        // );

        // foreach($this->scientists->findAll() as $scientist) {
        //     echo $scientist->getFullname() . '<br>';
        // };

        $scientists = $this->scientists->findAll();
        $scientist  = new Scientist();

        return view("scientist.index", compact('scientists', 'scientist'));
        // $scientist = new Scientist('Junior', 'Soares');
        // $scientist->setFirstname('Junior');
        // $scientist->setLastname('Soares');

        // $scientist->addTheory(
        //     new Theory('Teoria da Relatividade')
        // );
        // $scientist->addTheory(
        //     new Theory('Teoria do buraco negro')
        // );
        // $scientist->addTheory(
        //     new Theory('Teoria da terra plana')
        // );             
        // FacadesEntityManager::persist($scientist);
        // FacadesEntityManager::flush();


        // $scientist = $this->em::find('Scientist', 15);
        // $scientist->addTheory(
        //     new Theory('Teoria de teste')
        // );        

        // dd($scientist);

        // $scientist->setFirstname('Carlos');
        // $scientist->setLastname('Augusto');

        // $scientist->addTheory(
        //     new Theory('Teoria da conspiração')
        // );

        // $this->em::persist($scientist);
        // $this->em::flush();

        // dd($scientist->getTheories()); 
    }
}
