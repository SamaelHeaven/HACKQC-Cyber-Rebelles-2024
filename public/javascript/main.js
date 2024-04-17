import { Application } from "./vendor/nova/nova.js";
import { HomeComponent } from "./components/HomeComponent.js";
import { MapComponent } from "./components/MapComponent.js";
import { PanelComponent } from "./components/PanelComponent.js";
Application.launch([
    HomeComponent.definition,
    MapComponent.definition,
    PanelComponent.definition
]);
