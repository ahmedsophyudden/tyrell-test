import { defineStore } from 'pinia'

export const useLayoutStore = defineStore({
    id: 'layout',
    state: () => ({
        hideConfigButton: false,
        isPinned: true,
        showConfig: false,
        sidebarType: "bg-white",
        isRTL: false,
        mcolor: "",
        darkMode: false,
        isNavFixed: false,
        isAbsolute: false,
        showNavs: true,
        showSidenav: true,
        showNavbar: true,
        showFooter: true,
        showMain: true,
        layout: "default"
    }),
    getters: {
    },
    actions: {
        toggleConfigurator() {
            this.showConfig = !this.showConfig;
        },
        navbarMinimize() {
            const sidenav_show = document.querySelector(".g-sidenav-show");

            if (sidenav_show.classList.contains("g-sidenav-hidden")) {
                sidenav_show.classList.remove("g-sidenav-hidden");
                sidenav_show.classList.add("g-sidenav-pinned");
                this.isPinned = true;
            } else {
                sidenav_show.classList.add("g-sidenav-hidden");
                sidenav_show.classList.remove("g-sidenav-pinned");
                this.isPinned = false;
            }
        },
        // sidebarType(data) {
        //     this.sidebarType = data;
        // },
        navbarFixed() {
            if (this.isNavFixed === false) {
                this.isNavFixed = true;
            } else {
                this.isNavFixed = false;
            }
        },

        toggleSidebarColor(data) {
            this.sidebarType = data;
        }
    }
})