import { Component } from '@angular/core';
import { NavController, LoadingController } from 'ionic-angular';
import { Storage } from '@ionic/storage';
import { ModalController } from 'ionic-angular';
import { NotificationsPage } from '../notifications/notifications';
import { PostProvider } from "../../providers/post-provider";



@Component({
  selector: 'page-local-weather',
  templateUrl: 'local-weather.html'
})
export class LocalWeatherPage {
 
load = new Promise(
  (resolve, reject) =>{
    const datas = this.kal;
    setTimeout(
      ()=>{
        resolve (datas);
      }, 1000
    );
  }
)
sms: string;
  toni: string;
  kal:string;
  cours: any =[];
fil: string;
  constructor(
    public navCtrl: NavController,public modalCtrl: ModalController, private postPvdr: PostProvider,
    private storage: Storage, public loadingCtrl: LoadingController) {
      
    }
ionViewWillEnter(){
  
    
    this.storage.get('session_storage').then((val) => {
      console.log('le nom est', val);
      this.toni = val;
  this.kal= this.toni['filiere'];
  console.log(this.kal);
    });
  
}

  
  ionViewDidLoad(){
    const loader = this.loadingCtrl.create({
      content: "Patientez...",
      duration: 4500
    });
    this.cours = []; 
    setTimeout(
      ()=>{
        this.ok();
      }, 3000
    );
    loader.present();
  }
  
  
  
  
  ok() {
    
    console.log(this.fil);
    if(this.fil != "") {

      let body ={
        fil: this.kal,
        aksi: 'cour'
      };
  
      this.postPvdr.postData(body, 'cours.php').subscribe(data =>{
        if(data.result != ""){
          for(let cour of data.result){
            this.cours.push(cour);
          }
                 }
                 else {
                  this.sms ="Aucune matiere fini";
                  console.log(this.sms);
                 }
       
        
      });

      this.kal='';
    }
   
  }
show(prof,matiere,salle){
console.log(prof,matiere,salle);
this.navCtrl.push(NotificationsPage, {
  professeur: prof,
  m: matiere,
  filiere: salle
});
}

  

}
