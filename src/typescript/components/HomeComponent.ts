import {Component, ComponentDefinition, State} from "../vendor/nova/nova.js";

export class HomeComponent extends Component {
    public static readonly definition: ComponentDefinition = this.define("home-component");
    @State public loaded: boolean = false;

    public override render(): string {
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