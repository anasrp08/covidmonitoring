<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin role
        $adminRole = new Role();
        $adminRole->name = "admin"; 
        $adminRole->display_name = "Admin";
        $adminRole->save();

        // Create Member role
        $userRole = new Role();
        $userRole->name = "user";
        $userRole->display_name = "User";
        $userRole->save();

        $direksiRole = new Role();
        $direksiRole->name = "direksi";
        $direksiRole->display_name = "Direksi";
        $direksiRole->save();

        $kadivRole = new Role();
        $kadivRole->name = "kadiv";
        $kadivRole->display_name = "Kadiv";
        $kadivRole->save();

        $kadepRole = new Role();
        $kadepRole->name = "kadep";
        $kadepRole->display_name = "Kadep";
        $kadepRole->save();
        $kasekRole = new Role();
        $kasekRole->name = "kasek";
        $kasekRole->display_name = "Kasek";
        $kasekRole->save();
        $kaunRole = new Role();
        $kaunRole->name = "kaun";
        $kaunRole->display_name = "Kaun";
        $kaunRole->save();




        // Create Admin sample
        $admin1 = new User();
        $admin1->name = 'Admin';
        $admin1->email = '6826@peruricovid'; 
        $admin1->username = '6826'; 
        $admin1->password = bcrypt('admin123');
        $admin1->avatar = "admin_avatar.jpg";
        $admin1->is_verified = 1;
        $admin1->save();
        $admin1->attachRole($adminRole);

        $admin2 = new User();
        $admin2->name = 'Admin';
        $admin2->email = '6834@peruricovid'; 
        $admin2->username = '6834'; 
        $admin2->password = bcrypt('admin123');
        $admin2->avatar = "admin_avatar.jpg";
        $admin2->is_verified = 1;
        $admin2->save();
        $admin2->attachRole($adminRole);

        $admin3 = new User();
        $admin3->name = 'Admin';
        $admin3->email = 'admin@peruricovid'; 
        $admin3->username = '7776'; 
        $admin3->password = bcrypt('admin123');
        $admin3->avatar = "admin_avatar.jpg";
        $admin3->is_verified = 1;
        $admin3->save();
        $admin3->attachRole($adminRole);

        $admin4 = new User();
        $admin4->name = 'Admin';
        $admin4->email = '7770@peruricovid'; 
        $admin4->username = '7770'; 
        $admin4->password = bcrypt('admin123');
        $admin4->avatar = "admin_avatar.jpg";
        $admin4->is_verified = 1;
        $admin4->save();
        $admin4->attachRole($adminRole);

        $admin5 = new User();
        $admin5->name = 'Admin';
        $admin5->email = '7766@peruricovid'; 
        $admin5->username = '7766'; 
        $admin5->password = bcrypt('admin123');
        $admin5->avatar = "admin_avatar.jpg";
        $admin5->is_verified = 1;
        $admin5->save();
        $admin5->attachRole($adminRole);

        $admin6 = new User();
        $admin6->name = 'Admin';
        $admin6->email = '7561@peruricovid'; 
        $admin6->username = '7561'; 
        $admin6->password = bcrypt('admin123');
        $admin6->avatar = "admin_avatar.jpg";
        $admin6->is_verified = 1;
        $admin6->save();
        $admin6->attachRole($adminRole);
       
        $admin7 = new User();
        $admin7->name = 'Admin';
        $admin7->email = '7525@peruricovid'; 
        $admin7->username = '7525'; 
        $admin7->password = bcrypt('admin123');
        $admin7->avatar = "admin_avatar.jpg";
        $admin7->is_verified = 1;
        $admin7->save();
        $admin7->attachRole($adminRole);

        $admin8 = new User();
        $admin8->name = 'Admin';
        $admin8->email = '6274@peruricovid'; 
        $admin8->username = '6274'; 
        $admin8->password = bcrypt('admin123');
        $admin8->avatar = "admin_avatar.jpg";
        $admin8->is_verified = 1;
        $admin8->save();
        $admin8->attachRole($adminRole);

       




        // Create Sample member
        $kadiv = new User();
        $kadiv->name = 'Kadiv';
        $kadiv->email = 'B866@limbahperuri'; 
        $kadiv->username = 'B866'; 
        $kadiv->password = bcrypt('operator123');
        $kadiv->avatar = "operator_avatar.png";
        $kadiv->is_verified = 1;
        $kadiv->save();
        $kadiv->attachRole($kadivRole);

        $kadiv = new User();
        $kadiv->name = 'Kadiv';
        $kadiv->email = '6224@limbahperuri'; 
        $kadiv->username = '6224'; 
        $kadiv->password = bcrypt('operator123');
        $kadiv->avatar = "operator_avatar.png";
        $kadiv->is_verified = 1;
        $kadiv->save();
        $kadiv->attachRole($kadivRole);

        $kadiv = new User();
        $kadiv->name = 'Kadiv';
        $kadiv->email = '7647@limbahperuri'; 
        $kadiv->username = '7647'; 
        $kadiv->password = bcrypt('operator123');
        $kadiv->avatar = "operator_avatar.png";
        $kadiv->is_verified = 1;
        $kadiv->save();
        $kadiv->attachRole($kadivRole);



        $direksi1 = new User();
        $direksi1->name = 'DU';
        $direksi1->email = 'D011@limbahperuri'; 
        $direksi1->username = 'D011'; 
        $direksi1->password = bcrypt('operator123');
        $direksi1->avatar = "operator_avatar.png";
        $direksi1->is_verified = 1;
        $direksi1->save();
        $direksi1->attachRole($direksiRole);

        $direksi2 = new User();
        $direksi2->name = 'DP';
        $direksi2->email = 'D012@limbahperuri'; 
        $direksi2->username = 'D012'; 
        $direksi2->password = bcrypt('operator123');
        $direksi2->avatar = "operator_avatar.png";
        $direksi2->is_verified = 1;
        $direksi2->save();
        $direksi2->attachRole($direksiRole);

        $direksi3 = new User();
        $direksi3->name = 'DS';
        $direksi3->email = 'D014@limbahperuri'; 
        $direksi3->username = 'D014'; 
        $direksi3->password = bcrypt('operator123');
        $direksi3->avatar = "operator_avatar.png";
        $direksi3->is_verified = 1;
        $direksi3->save();
        $direksi3->attachRole($direksiRole);

        $direksi4 = new User();
        $direksi4->name = 'DK';
        $direksi4->email = 'D015@limbahperuri'; 
        $direksi4->username = 'D015'; 
        $direksi4->password = bcrypt('operator123');
        $direksi4->avatar = "operator_avatar.png";
        $direksi4->is_verified = 1;
        $direksi4->save();
        $direksi4->attachRole($direksiRole);

        $direksi5 = new User();
        $direksi5->name = 'DM';
        $direksi5->email = 'D016@limbahperuri'; 
        $direksi5->username = 'D016'; 
        $direksi5->password = bcrypt('operator123');
        $direksi5->avatar = "operator_avatar.png";
        $direksi5->is_verified = 1;
        $direksi5->save();
        $direksi5->attachRole($direksiRole);


        // $uk = new User();
        // $uk->name = 'Super User';
        // $uk->email = 'superuser@peruricovid'; 
        // $uk->username = '7778'; 
        // $uk->password = bcrypt('superuser123');
        // $uk->avatar = "operator_avatar.png";
        // $uk->is_verified = 1;
        // $uk->save();
        // $uk->attachRole($unitKerjaRole);

        // $pengawas = new User();
        // $pengawas->name = 'Pengawas';
        // $pengawas->email = 'pengawas@limbahperuri'; 
        // $pengawas->username = '7779'; 
        // $pengawas->password = bcrypt('pengawas123');
        // $pengawas->avatar = "operator_avatar.png";
        // $pengawas->is_verified = 1;
        // $pengawas->save();
        // $pengawas->attachRole($satpamRole);

    }
}
