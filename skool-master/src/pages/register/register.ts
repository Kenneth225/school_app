import {Component} from "@angular/core";
import {NavController, App, ToastController, LoadingController} from "ionic-angular";
import {LoginPage} from "../login/login";
import { PostProvider } from '../../providers/post-provider';


@Component({
  selector: 'page-register',
  templateUrl: 'register.html'
})
export class RegisterPage {
  nom: string='';
  matricule: string='';
  mail: string='';
  mdp: string='';
  filiere: string='';
  semestre: string='';
  constructor(public nav: NavController,
    private postPvdr: PostProvider,public loadingCtrl: LoadingController,
    private appCtrl: App,public toastCtrl: ToastController) {
  }

  // register and go to home page
  register() {
if(this.matricule!=""){
  const loader = this.loadingCtrl.create({
    content: "Patientez...",
    duration: 4500
  });
  let body ={
    nom: this.nom,
    matricule: this.matricule,
    mail: this.mail,
    mdp:  this.mdp, 
    filiere: this.filiere,
    semestre: this.semestre,
    aksi: 'adduser'
  };
  this.postPvdr.postData(body, 'loginv.php').subscribe((data)=>
  {
      if(data.success){
        const toast = this.toastCtrl.create({
          message: 'Verifier vos entrées et réessayer',
          duration: 4500
        });
        toast.present();
      }else{
        this.postPvdr.postData(body, 'logup.php').subscribe((data)=>
  {
      var alertpesan = data.msg;
      if(data.success){
        this.appCtrl.getRootNav().setRoot(LoginPage);
    const toast = this.toastCtrl.create({
      message: 'Enregistrement Effectué; Connectez vous!!',
      duration: 4500
    });
    toast.present();
      }else if (data.suc){
        const toast = this.toastCtrl.create({
          message: alertpesan,
          duration: 3000
        });
        toast.present();
      }else{
        const toast = this.toastCtrl.create({
          message: 'Verifier vos entrées et réessayer',
          duration: 4500
        });
        toast.present();
      }
  });
      }
  });
  
  
loader.present();
}

  }


  

  // go to login page
  login() {
    this.nav.setRoot(LoginPage);
  }
}
