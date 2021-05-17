<!--<template>-->
<!--    <div class="custom-control custom-switch">-->
<!--        <label >-->
<!--            <span v-if="isActive" class="toggle__label">On</span>-->
<!--            <span v-if="! isActive" class="toggle__label">Off</span>-->

<!--            <input type="checkbox" class="custom-control-input" id="customSwitch1" v-model="checkedValue">-->
<!--            <input type="hidden" name="_method" value="PUT">-->
<!--            <span class="toggle__switch"></span>-->
<!--        </label>-->
<!--    </div>-->
<!--    &lt;!&ndash; /.custom-control custom-switch &ndash;&gt;-->
<!--</template>-->

<!--<script>-->

<!--export default {-->
<!--    props: {-->
<!--        defaultState: {-->
<!--            type: Number,-->
<!--            default: 0,-->
<!--        }-->
<!--    },-->
<!--    data() {-->
<!--        return {-->
<!--            currentState: this.defaultState === 0 ? false : true,-->
<!--        }-->
<!--    },-->

<!--    computed: {-->
<!--        isActive() {-->
<!--            return this.currentState;-->
<!--        },-->

<!--        checkedValue: {-->
<!--            get() {-->
<!--                return this.defaultState-->
<!--            },-->
<!--            set(newValue) {-->
<!--                this.currentState = newValue;-->
<!--                this.$emit('change', this.currentState);-->
<!--            }-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

<!--<style >-->

<!--#toggle_button {-->
<!--    vertical-align: middle;-->
<!--    user-select: none;-->
<!--    cursor: pointer;-->
<!--}-->
<!--#toggle_button input[type="checkbox"] {-->
<!--    opacity: 0;-->
<!--    position: absolute;-->
<!--    width: 1px;-->
<!--    height: 1px;-->
<!--}-->
<!--#toggle_button toggle__switch {-->
<!--    display:inline-block;-->
<!--    height:12px;-->
<!--    border-radius:6px;-->
<!--    width:40px;-->
<!--    background: #BFCBD9;-->
<!--    box-shadow: inset 0 0 1px #BFCBD9;-->
<!--    position:relative;-->
<!--    margin-left: 10px;-->
<!--    transition: all .25s;-->
<!--}-->

<!--#toggle_button toggle__switch::after,-->
<!--#toggle_button toggle__switch::before {-->
<!--    content: "";-->
<!--    position: absolute;-->
<!--    display: block;-->
<!--    height: 18px;-->
<!--    width: 18px;-->
<!--    border-radius: 50%;-->
<!--    left: 0;-->
<!--    top: -3px;-->
<!--    transform: translateX(0);-->
<!--    transition: all .25s cubic-bezier(.5, -.6, .5, 1.6);-->
<!--}-->

<!--#toggle_button toggle__switch::after {-->
<!--    background: #4D4D4D;-->
<!--    box-shadow: 0 0 1px #666;-->
<!--}-->
<!--#toggle_button toggle__switch::before {-->
<!--    background: #4D4D4D;-->
<!--    box-shadow: 0 0 0 3px rgba(0,0,0,0.1);-->
<!--    opacity:0;-->
<!--}-->
<!--</style>-->
