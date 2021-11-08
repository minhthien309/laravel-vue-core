<template>
    <a-list :grid="{ gutter: 16, xs: 1, sm: 2, md: 4, lg: 4, xl: 6, xxl: 3 }" :data-source="data">
        <a-list-item slot="renderItem" slot-scope="item">
            <a-card hoverable>
                <template slot="actions" class="ant-card-actions">
                    <span>{{item.name}}</span>
                </template>
                <a-icon :type="'user'" />
            </a-card>
        </a-list-item>
    </a-list>
</template>
<script>
export default{
    data(){
        return {
            data: []
        }
    },
    methods: {
        getFile: function(){
            this.$axios.get('file-manager/get-file')
            .then(res => {
                let resData = res.data.data;
                for(let i=0; i<resData.length; i++){
                    let tmp = {
                        name: resData[i]['filename'],
                        nameWithExtension: resData[i]['path'],
                        icon: resData[i]['type'],
                        timestamp: resData[i]['timestamp'],
                        size: resData[i]['size'],
                        extension: resData[i]['extension']
                    }
                    this.data.push(tmp);
                }
            });
        }
    },
    mounted(){
        this.getFile();
    }
}
</script>