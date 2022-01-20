<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use LaravelDoctrine\ORM\Facades\EntityManager as FacadesEntityManager;
use Scientist;
use ScientistRepository;
use Symfony\Component\Serializer\Encoder\JsonEncode;
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

        foreach($this->scientists->findAll() as $sci) {
            $scientists[] = $sci->toArray();
        }
        
        $scient = $this->em::find('Scientist', 15);
        $scientist = $scient->toArray();

        $title = 'Ola view feita em Vue!';

        return Inertia::render("Scientist", compact('scientists', 'scientist', 'title'));

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

    private static function toArray($object) {
        $reflectionClass = new \ReflectionClass($object);
    
        $properties = $reflectionClass->getProperties();
    
        $array = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $value = $property->getValue($object);

            dd($properties);

        }


        die;

        return $array;
    }  


    public function login(Request $request) {
        if(!empty($request->input())){
            $request->validate([
                'email'    => ['required', 'email'],
                'password' => ['required']
            ]);
            return redirect('dashboard');
        }
        return Inertia::render("Login");
    }

}
