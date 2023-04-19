<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Visibilite;
use App\Models\Etat;
use App\Models\Type_media;
use App\Models\Permission;
use App\Models\Role;
use App\Models\ModelMeteo;
use DB;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $visibilites = ['Confidentiel', 'Privé', 'Public'];
        $etats = ['En cours', 'Publié', 'Archivé'];
        $typesMedia=['video', 'image'];
        $roleIncr=['Super_Admin' , 'guest' , 'Admin_Editeur' , 'Admin_Gestion'];
        $permissionIncr=['Gestion_Evenement' , 'Gestion_Article' , 'Gestion_News' , 'Gestion_Meteo' , 'Gestion_reglement' , 'Gestion_nds' ];
        
        
        foreach ($visibilites as $visibilite) {
            Visibilite::factory()->create([
                'nom' => $visibilite,
            ]);
        }
        foreach ($etats as $etat) {
            Etat::factory()->create([
                'nom' => $etat,
            ]);
        }
       
        foreach ($typesMedia as $typeMedia) {
            Type_Media::factory()->create([
                'nom' => $typeMedia,
            ]);
        }


        foreach ($roleIncr as $roleIncr) {
            Role::factory()->create([
                'nom' => $roleIncr,
            ]);
        }
        foreach ($permissionIncr as $permissionIncr) {
            Permission::factory()->create([
                'nom' => $permissionIncr,
            ]);
        }



        // seeder table pivot permission_role
        $role1 = Role::first();
        $role3 = Role::skip(2)->first();
        $role4 = Role::skip(3)->first();
        $permissionAll = Permission::all();

        foreach ($permissionAll as $permission) {
            DB::table('permission_role')->insert([
                'role_id' => $role1->id,
                'permission_id' => $permission->id,
                'created_at' => now(),
                'updated_at' => now(),
                
            ]);
        }
        for ($i = 0 ; $i < 3 ; $i++){
            $permission = $permissionAll->get($i);
            DB::table('permission_role')->insert([
                'role_id' => $role1->id,
                'permission_id' => $permission->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 0 ; $i < 3 ; $i++){
            $permission = $permissionAll->get($i);
            DB::table('permission_role')->insert([
                'role_id' => $role3->id,
                'permission_id' => $permission->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 3 ; $i < 6 ; $i++){
            $permission = $permissionAll->get($i);
            DB::table('permission_role')->insert([
                'role_id' => $role4->id,
                'permission_id' => $permission->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //seeder météo
        $ville = ['balma'];
        $name =  ['afpa'];
        //$response = \Http::get('https://www.prevision-meteo.ch/services/json/balma'); 
        $json = file_get_contents('https://www.prevision-meteo.ch/services/json/balma');
        $tab = [$json];
        

       

        ModelMeteo::factory()->create([
            'nom' => $name,
            'ville' => $ville,
            'json' =>  $tab,
          
            

        ]);
        
            
         

        
        /* Visibilite::factory(3)->create(); */
        /* Etat::factory(3)->create(); */
        /*  Type_Media::factory(2)->create(); */
        

    
        }
}
