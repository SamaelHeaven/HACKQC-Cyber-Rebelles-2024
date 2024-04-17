var _a;
import { Component } from "../vendor/nova/nova.js";
export class HomeComponent extends Component {
    render() {
        return `
            <div class="flex-grow-1 w-100 row m-0 border border-5">
                <map-component></map-component>
                <panel-component></panel-component>
            </div>
        `;
    }
}
_a = HomeComponent;
HomeComponent.definition = _a.define("home-component");
