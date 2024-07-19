<template>
    <header class="fixed-top" style="height: 48px">
        <nav class="navbar navbar-expand-lg bg-body-tertiary py-0">
            <div class="container-fluid rounded-3 rounded-top-0 bg-primary">
                <a class="navbar-brand text-white" href="/">
                    <img
                        src="/assets/logo_48x48.svg"
                        alt="Bootstrap"
                        style="height: 1em"
                    />
                    業務システム（仮）
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse justify-content-end"
                    id="navbarNav"
                >
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a
                                class="nav-link text-white active"
                                aria-current="page"
                                @click="mypageClick"
                            >
                                <icon font="mdi mdi-home-circle-outline" />
                                <span class="d-none d-md-inline px-1">
                                    マイページ
                                </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle text-white"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <icon font="mdi mdi-account-circle" />
                                <span class="d-none d-md-inline px-1">
                                    アカウント
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <icon font="mdi mdi-cog-outline" />
                                        <span class="px-1">プロフィール</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider" /></li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <icon font="mdi mdi-logout" />
                                        <span class="px-1">ログアウト</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
// import { mdiAccount, mdiHomeCircleOutline } from "@mdi/js";

export default {
    data() {
        return {
            //
            // mdiAccount,
            // mdiHomeCircleOutline,
        };
    },

    compute: {
        //
    },

    watch: {
        //
    },

    methods: {
        //
        mypageClick() {
            console.log("マイページをクリック！！");
        },
    },
};
</script>
