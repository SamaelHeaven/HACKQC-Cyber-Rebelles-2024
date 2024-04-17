import {Component, ComponentDefinition} from "../vendor/nova/nova.js";

export class HomeComponent extends Component {
    public static readonly definition: ComponentDefinition = this.define("home-component");

    public override render(): string {
        return `
            <div class="flex-grow-1 w-100 row m-0 border border-5">
                <map-component></map-component>
                <panel-component></panel-component>
            </div>
        `;
    }
}