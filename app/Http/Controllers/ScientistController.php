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
    private $scientistsRp;

    /**
     * 
    */
    public function __construct(ScientistRepository $scientists)
    {
        $this->em = new FacadesEntityManager;

        $this->scientistsRp = $scientists;
    }    

    public function index() {

        foreach($this->scientistsRp->findAll() as $sci) {
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

    // private static function toArray($object) {
    //     $reflectionClass = new \ReflectionClass($object);
    
    //     $properties = $reflectionClass->getProperties();
    
    //     $array = [];
    //     foreach ($properties as $property) {
    //         $property->setAccessible(true);
    //         $value = $property->getValue($object);
    //     }

    //     return $array;
    // }  

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

    public function scientistIndex($page = 1) {
        $title = "Lista de nomes ";

        //dd($page);
        $paginacao = $this->scientistsRp->pagAll(5, $page);

        foreach( $paginacao as $sci) {
            $scientists[] = $sci->toArray();
        }

        //dd($paginacao);

        return Inertia::render("ScientistIndex", compact('title', 'scientists', 'paginacao'));
    }    


    public function scientistNew(Request $request, $id = null) {
        if(!empty($request->input())){
            $data = $request->all();
            unset($data['theories']);
            $id = isset($data['id']) ? $data['id'] : $id;
            $request->validate([
                'firstname'    => ['required'],
                'lastname'     => ['required']
            ]);
            if($id) {
                unset($data['id']);
                $entity = $this->scientistsRp->update($data, $id);
            } else {
                $entity = $this->scientistsRp->insert($data);
            }

            if($entity) {
                return redirect('sciIndex');
            }
        }
        $entity = new Scientist();
        if($id) {
            $entity = $this->scientistsRp->find($id);
        }    

        return Inertia::render("ScientistNew", ['entity' => $entity->toArray()]);
    }      

    public function delete($id) {
        if($id) {
            $this->scientistsRp->delete(null, $id);
        }

        return redirect('sciIndex');
    }       

}
