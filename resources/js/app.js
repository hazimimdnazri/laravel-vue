import "./bootstrap";
import { createApp } from "vue";

import LoginComponent from "./Components/LoginComponent.vue";
import RegisterComponent from "./Components/RegisterComponent.vue";
import TopbarComponent from "./Components/Layouts/TopbarComponent.vue";
import SidebarComponent from "./Components/Layouts/SidebarComponent.vue";
import TaskComponent from "./Components/TaskComponent.vue";


const app = createApp({});
app.component("login-component", LoginComponent);
app.component("register-component", RegisterComponent);
app.component("topbar-component", TopbarComponent);
app.component("sidebar-component", SidebarComponent);
app.component("task-component", TaskComponent);
app.mount("#app")