import {Component} from "@angular/core";
import { ViewController, NavParams, ToastController, LoadingController } from 'ionic-angular';
import { PostProvider } from '../../providers/post-provider';
import { Storage } from '@ionic/storage';

@Component({
  selector: 'page-notifications',
  templateUrl: 'notifications.html'
})
export class NotificationsPage {
  professeur: any;
  f: any;
  m: any;
  kal:string;
 toni: any = [];
  matiere: string='';
  filiere: string='';
  student: string='';
  prof: string='';
  glo: number;
  ped: number;
  con: number;
  org: number;
  un: number;
  deux: number;
  trois: number;
  quatre: number;
  cinq: number;
  six: number;
  note: number;
  constructor(public viewCtrl: ViewController, private postPvdr: PostProvider, 
    public navParams: NavParams,public loadingCtrl: LoadingController,private storage: Storage, public toastCtrl: ToastController) {}

  
  ionViewDidLoad() {
    this.professeur = this.navParams.get('professeur');
    this.m =this.navParams.get('m');
    this.f =this.navParams.get('filiere');
    this.storage.get('session_storage').then((val) => {
      this.toni = val;
  this.kal= this.toni['nom'];
  console.log(this.kal);
});
  }

  noter() {
    const loader = this.loadingCtrl.create({
      content: "Patientez...",
      duration: 5000
    });
if(this.glo){
  this.note = +this.glo + + this.con + + this.org + + this.ped + + this.un + + this.deux + + this.trois+ +this.quatre + + this.cinq + + this.six;
  console.log(this.note*1);
  let body ={
    glo: this.glo,
    con: this.con,
    org: this.org,
    ped: this.ped,
    un: this.un,
    deux : this.deux,
    trois :this.trois,
    quatre : this.quatre,
    cinq :this.cinq,
    six : this.six,
    matiere: this.matiere,
filiere: this.filiere,
prof: this.prof,
note: this.note,
student: this.student,
    aksi: 'addnote'
  };
  this.postPvdr.postData(body, 'noterv.php').subscribe((data)=>
  {
      if(data.success){
        const toast = this.toastCtrl.create({
          message: 'Matière Déja Noté',
          duration: 4500
        });
        toast.present();
      }else{
        this.postPvdr.postData(body, 'noter.php').subscribe((data)=>
  {
      if(data.success){
    const toast = this.toastCtrl.create({
      message: 'Enregistrement Effectué!',
      duration: 4500
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

  this.postPvdr.postData(body, 'stat.php').subscribe((data)=>
  {
      if(data.success){
    const toast = this.toastCtrl.create({
      message: 'Statistique enregistré!',
      duration: 5500
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

  
  
}
loader.present(); 
  }
}
