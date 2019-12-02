import { Component } from '@angular/core';
import {  NavController, NavParams, ToastController, MenuController, LoadingController, AlertController } from 'ionic-angular';
import { Storage } from '@ionic/storage';
import { PostProvider } from '../../providers/post-provider';
import { RegisterPage } from '../register/register';
import { HomePage } from '../home/home';
@Component({
  selector: 'page-login',
  templateUrl: 'login.html'
})
export class LoginPage {

  
  matricule: string;
  pass: string;
  appCtrl: any;
  constructor(public nav: NavController, public navParams: NavParams, 
    public toastCtrl: ToastController, private postPvdr: PostProvider,
    public storage: Storage,public loadingCtrl: LoadingController,
    public menu: MenuController,public alertCtrl: AlertController) {this.menu.swipeEnable(false);
  }

 

  // go to register page
  register() {
    this.nav.setRoot(RegisterPage);
  }

  // login and go to home page
  login() {
    console.log(this.matricule);
    if(this.matricule == ""){
      const toast = this.toastCtrl.create({
        message: 'Le matricule est requis',
        duration: 3000
      });
      toast.present();
  }else if(this.pass == ""){
    const toast = this.toastCtrl.create({
      message: 'Le Mot de Passe est requis',
      duration: 3000
    });
    toast.present();

  }
    else if(this.matricule != "" && this.pass != ""){
      const loader = this.loadingCtrl.create({
        content: "Patientez...",
        duration: 4500
      });
      let body = {
        matricule: this.matricule,
        pass: this.pass,
        aksi: 'connect'
      };
    
      this.postPvdr.postData(body, 'login.php').subscribe((data)=>
      {
          var alertpesan = data.msg;
          if(data.success){
            this.storage.set('session_storage', data.result);
            this.nav.setRoot(HomePage);
            this.storage.get('session_storage').then((val) => {
              console.log('les donnees sont', val);
              
            });
            const toast = this.toastCtrl.create({
              message: 'Connexion effectué',
              duration: 3000
            });
            toast.present();
          }else{
            const toast = this.toastCtrl.create({
              message: alertpesan,
              duration: 3000
            });
            toast.present();
          }
      });
      
    loader.present();
    }else {
      const toast = this.toastCtrl.create({
        message: 'Matricule ou Mot de Passe erroné',
        duration: 3000
      });
      toast.present();
    }
    
      }
  

  forgotPass() {
    let forgot = this.alertCtrl.create({
      title: 'Forgot Password?',
      message: "Enter you email address to send a reset link password.",
      inputs: [
        {
          name: 'email',
          placeholder: 'Email',
          type: 'email'
        },
      ],
      buttons: [
        {
          text: 'Cancel',
          handler: data => {
            console.log('Cancel clicked');
          }
        },
        {
          text: 'Send',
          handler: data => {
            console.log('Send clicked');
            let toast = this.toastCtrl.create({
              message: 'Email was sended successfully',
              duration: 3000,
              position: 'top',
              cssClass: 'dark-trans',
              closeButtonText: 'OK',
              showCloseButton: true
            });
            toast.present();
          }
        }
      ]
    });
    forgot.present();
  }

}
