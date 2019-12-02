import {Component} from "@angular/core";
import { NavController, App, LoadingController, ToastController } from 'ionic-angular';
import { Storage } from '@ionic/storage';
import { PostProvider } from "../../providers/post-provider";

@Component({
  selector: 'page-search-location',
  templateUrl: 'search-location.html'
})

export class SearchLocationPage {
  msgs: any =[];
  message: string='';
  toni: any = [];
  me: string='';
  constructor(public toastCtrl: ToastController,
    public nav: NavController,
    private postPvdr: PostProvider,
  public loadingCtrl: LoadingController,
    private storage: Storage,private appCtrl:App){}

    ionViewDidLoad(){
      const loader = this.loadingCtrl.create({
        content: "Patientez...",
        duration: 4500
      });
      loader.present();
      this.storage.get('session_storage').then((val) => {
        this.toni = val;
    console.log(this.toni['nom']);
    this.me = this.toni;
      });
      this.charge();
    }

    
send(){
if(this.message!= "" ){
  const toast = this.toastCtrl.create({
    message: 'Envoie en cour...',
    duration: 4000
  });
  toast.present();
  let body ={
    auteur: this.toni['nom'],
    message: this.message,
    aksi: 'texto'
  };
  this.postPvdr.postData(body, 'forum.php').subscribe(data =>{
    this.appCtrl.getRootNav().setRoot(SearchLocationPage);
  });
}
  
}

charge() {
  let body ={

  };

  this.postPvdr.postData(body, 'text.php').subscribe(data =>{
    for(let msg of data.result){
      this.msgs.push(msg);
    }
  });
}


  


  }
