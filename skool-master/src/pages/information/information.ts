import { Component } from '@angular/core';
import { IonicPage, NavController,  ToastController, LoadingController, App } from 'ionic-angular';
import { PostProvider } from '../../providers/post-provider';
import { Storage } from '@ionic/storage';
import { HomePage } from '../home/home';

@IonicPage()
@Component({
  selector: 'page-information',
  templateUrl: 'information.html',
})
export class InformationPage {
  titre: string;
  contenu: string;
  fil: string;
  autor: string;
  titi: any;
  role: string;
  kal:string;

  constructor(public navCtrl: NavController, public nav: NavController,
    private postPvdr: PostProvider,public loadingCtrl: LoadingController,
public toastCtrl: ToastController,private appCtrl:App,private storage: Storage) {
  }

  ionViewDidLoad() {
    this.storage.get('session_storage').then((val) => {
      this.titi = val;
  this.kal= this.titi['filiere'];
    });
  }

  save() {
    if(this.titre != ""){
      
      let body ={
        title: this.titre,
        message: this.contenu,
        salle: this.fil,
        auth: this.autor,
        aksi: 'new'
      };
      this.postPvdr.postData(body, 'new.php').subscribe(data =>{
        this.appCtrl.getRootNav().setRoot(HomePage);
      });
      const toast = this.toastCtrl.create({
        message: 'Enregistrement effectué',
        duration: 3000
      });
      toast.present();
    }
    
      }

}
