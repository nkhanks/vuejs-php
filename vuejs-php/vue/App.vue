<template>
    <div> 
        <div v-if="show">
            <transition name="slide-fade" mode="out-in">
                <div class="container gap-50"  >
                    <div class="1-three center">
                        <img :src="logo_php" />
                    </div>
                    <div class="2-three center">
                        <img :src="logo_js" />
                    </div>
                    <div class="3-three center">
                        <img :src="'assets/img/'+logo_vue" />
                    </div>
                    <message ></message>
                </div>
            </transition>
        </div>
        <div v-else >
            <div  class="center pad-60" >
                <button @click="showLogo" >CLICK ME</button>
            </div>
        </div>
        </transition>

    </div>
</template>

<script>
    /**
     * example 
     * 
     * 
     * 
     * 
     */
    import message from "otherComponent.vue"
    export default{
        components: {
            message
        },
        data() {
            return {
                show: false,
                logo_php: "assets/img/php.png",
                logo_js: "assets/img/js.png",
                logo_vue: "vue.png"
            }
        },
        methods: {
            showLogo() {
                this.show = !this.show;
            }
        }

    }
</script>

<style>
    .container{
        padding-top: 80px;
        overflow: none;
        img{
            width: 130px;
        }
    }

    .pad-60{
        padding: 80px;        
    }

    button{
        padding: 20px;
        padding-left: 60px;
        padding-right: 60px;
        color: #fff;
        border: none;
        border-radius: 34px;
        font-size: 18px;
        background: #333;
        transition: 200ms ease-in;
        animation: glow 1.5s ease-in-out infinite alternate;
        &:hover{

            cursor: pointer;
            background: linear-gradient(90deg,rgba(247,224,24,1)  0%,rgba(77,186,135,1)  50%, rgba(78,89,149,1) 100%);
        }
    }

    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to{
        transform: translateX(10px);
        opacity: 0;
    }

    @-webkit-keyframes glow{
        from {
            box-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #fff, 0 0 40px rgba(0,0,0,0.4), 0 0 70px rgba(0,0,0,0.4), 0 0 80px rgba(0,0,0,0.4), 0 0 100px rgba(0,0,0,0.4), 0 0 150px rgba(0,0,0,0.4);
        }
        to {
            box-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #fff, 0 0 20px rgba(0,0,0,0.4), 0 0 35px rgba(0,0,0,0.4), 0 0 40px rgba(0,0,0,0.4), 0 0 50px rgba(0,0,0,0.4), 0 0 75px rgba(0,0,0,0.4);
        }
    }

</style>