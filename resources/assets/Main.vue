<style></style>


<template>
    <div class="wrapper">
        <p>PDF EDITOR</p>
        <ToolBar></ToolBar>
        <ThumbnailGrid></ThumbnailGrid>
        <Preview></Preview>
    </div>
</template>

<script>
import Preview from '@/vendor/brandjaws/pdf-editor/components/Preview.vue'
import ThumbnailGrid from '@/vendor/brandjaws/pdf-editor/components/ThumbnailGrid'
import ToolBar from "@/vendor/brandjaws/pdf-editor/components/ToolBar.vue";
    export default {
        components:{
            ToolBar,
            ThumbnailGrid,
            Preview,
        }
    }
</script>
