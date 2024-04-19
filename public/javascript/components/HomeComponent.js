var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var _a;
import { Component, State } from "../vendor/nova/nova.js";
export class HomeComponent extends Component {
    constructor() {
        super(...arguments);
        this.loaded = false;
    }
    render() {
        return `
            <div class="flex-grow-1 w-100 row m-0 border border-5">
                ${this.loaded ? "" : `
                    <div class="d-flex justify-content-center align-items-center">
                        <img class="loader" src="/images/loader.gif" alt="Chargement...">
                    </div>
                `}
                <map-component></map-component>
                <panel-component ${this.loaded ? "" : `class="d-none"`}></panel-component>
            </div>
        `;
    }
}
_a = HomeComponent;
HomeComponent.definition = _a.define("home-component");
__decorate([
    State,
    __metadata("design:type", Boolean)
], HomeComponent.prototype, "loaded", void 0);
