<template>   
  <div>     
    <keep-alive>       
      <component v-bind:is="dynamic"/>
    </keep-alive>   
  </div> 
</template>



<script>
import aboutVue from './about.vue';

export default 
{
    data : function ()
    {
        return{ 
            dynamic: aboutVue
        }

    },
    components:{aboutVue}
}
</script>
