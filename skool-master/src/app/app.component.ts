import { Component, ViewChild } from "@angular/core";
import { Platform, Nav, LoadingController } from "ionic-angular";
import { Storage } from '@ionic/storage';
import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { Keyboard } from '@ionic-native/keyboard';

import { HomePage } from '../pages/home/home';
import { LoginPage } from "../pages/login/login";
import { LocalWeatherPage } from "../pages/local-weather/local-weather";
import { SearchLocationPage } from "../pages/search-location/search-location";
import { PostProvider } from "../providers/post-provider";

export interface MenuItem {
    title: string;
    component: any;
    icon: string;
    
}

@Component({
  templateUrl: 'app.html'
})

export class MyApp {
  kal:string;
    toni: any = [];
  @ViewChild(Nav) nav: Nav;

  rootPage: any;

  appMenuItems: Array<MenuItem>;

  constructor(
    private postPvdr: PostProvider,
    public platform: Platform,
    public statusBar: StatusBar,
    public splashScreen: SplashScreen,
    public keyboard: Keyboard,
    public loadingCtrl: LoadingController,
    private storage: Storage
  ) {
    this.initializeApp();
    
       
    this.appMenuItems = [
      {title: 'Acceuil', component: HomePage, icon: 'home'},
      {title: 'Cours Effectué', component: LocalWeatherPage, icon: 'md-checkmark'},
      {title: 'Forum', component: SearchLocationPage, icon: 'md-chatboxes'},
    ];
  }

  initializeApp() {
    this.storage.get('session_storage').then((res)=>{
      if(res == null){
        this.rootPage = LoginPage;
      } else {
        this.rootPage = HomePage;
      }
    });

    this.platform.ready().then(() => {
      // Okay, so the platform is ready and our plugins are available.

      //*** Control Splash Screen
      // this.splashScreen.show();
      // this.splashScreen.hide();

      //*** Control Status Bar
      this.statusBar.styleDefault();
      this.statusBar.overlaysWebView(false);

      //*** Control Keyboard
      this.keyboard.hide;
    });
  }
  

  openPage(page) {
    // Reset the content nav to have just this page
    // we wouldn't want the back button to show in this scenario
    this.nav.setRoot(page.component);
  }

  logout() {
    const loader = this.loadingCtrl.create({
      content: "Patientez...",
      duration: 3000
    });
    loader.present();
    let body = {
      aksi: 'out'
    };
    this.postPvdr.postData(body,'logout.php').subscribe((data)=>{
    this.storage.set('session_storage', data.result);
    this.nav.setRoot(LoginPage);
    this.storage.get('session_storage').then((val) => {
      console.log('les donnees sont', val);
    });
  });
    
  }

}
