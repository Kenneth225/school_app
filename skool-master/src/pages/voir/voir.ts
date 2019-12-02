import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams} from 'ionic-angular';


/**
 * Generated class for the VoirPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-voir',
  templateUrl: 'voir.html',
})
export class VoirPage {
pid: number;
  contenu: string;
  vue: string;
  constructor(public navCtrl: NavController, public navParams: NavParams) {
  }

  ionViewDidLoad() {
    this.pid = this.navParams.get('postid');
    this.contenu = this.navParams.get('postmsg');
    this.vue = this.navParams.get('postimg');
  }

}
