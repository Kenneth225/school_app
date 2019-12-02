import {Component} from "@angular/core";
import {NavController, PopoverController} from "ionic-angular";
import { PostProvider } from "../../providers/post-provider";
import { VoirPage } from "../voir/voir";
import { Storage } from '@ionic/storage';
import { InformationPage } from '../information/information';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})

export class HomePage {
  titi: any;
  badge: string;
  badgo: string;
  role: string;
  salle: string;
  infos: any = [];
  kal:string;
coms: any =[];
toni: any = [];
cours: any =[];
fil: string;
  constructor( public nav: NavController,
     public popoverCtrl: PopoverController,
     private postPvdr: PostProvider,
     private storage: Storage) {
      
  }
 

  ionViewWillEnter(){
    
  }

  ionViewDidLoad(){
    

    this.infos = [];
    this.coms = [];
    this.cours = [];
    this.loadc();
    //this.ok();
    this.storage.get('session_storage').then((val) => {
  this.titi = val;
  this.kal = this.titi['filiere'];
          this.role= this.titi['role'];
               console.log(this.role);
    });
  }
  
  
  
  ok() {
    
     let body ={
      salle: this.salle,
        aksi: 'comuno'
    };
      this.postPvdr.postData(body, 'register.php').subscribe(data =>{
        if(data.result != ""){
       for(let info of data.result){
          this.infos.push(info);
      }
        } else{
          this.badge ="Aucune Information Disponible";
          console.log(this.badge);
         }
    });
this.kal='';
  }

  loadc() {
    let body ={
      aksi: 'com'
    };

    this.postPvdr.postData(body, 'load.php').subscribe(data =>{
      if(data.result != ""){
      for(let com of data.result){
        this.coms.push(com);
      }} else{
        this.badgo ="Aucune Information Disponible";
        console.log(this.badgo);
       }
    });
    console.log(this.kal);
  }

  showtxt(id, msg, vue){
console.log(id,msg);
this.nav.push(VoirPage, {
  postid: id,
  postmsg: msg,
  postimg: vue
});
  }

  showcom(id, contenu,vue){
    console.log(id,contenu);
    this.nav.push(VoirPage, {
      postid: id,
      postmsg: contenu,
      postimg: vue
    });
      }
      new(){
        this.nav.push(InformationPage);
      }

}

