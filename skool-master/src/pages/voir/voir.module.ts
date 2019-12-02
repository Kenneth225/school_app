import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { VoirPage } from './voir';

@NgModule({
  declarations: [
    VoirPage,
  ],
  imports: [
    IonicPageModule.forChild(VoirPage),
  ],
})
export class VoirPageModule {}
