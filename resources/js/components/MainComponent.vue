<template>
    <div class="container mt-2">
        <div class="row mb-3">
            <div class="col-md-12">
                    <label for="inlineFormInputName2">Sort By</label>
                    <select class="custom-form-control" @change="getUserInfo($event)" id="inlineFormInputName2" style="width:auto;display:inline-block">
                        <option v-for="(sortItem,index) in sortBy" :key="index">{{sortItem}}</option>
                    </select>
            </div>
            <div class="col-md-6 col-lg-4 mt-3" v-for="user in usersInfo" :key="user.id">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="image-div">
                            <h1 class="name-first-alpha">{{user.name.charAt(0)}}</h1>
                            <!-- <img v-else :src="user.avatar" height="80"/> -->
                        </div>
                        <h4 class="mb-0">{{user.name}}</h4>
                        <p class="mt-0 color-gray">{{user.occupation}}</p>
                        <div class="row">
                            <div class="col">
                                <h5 class="mb-0">{{user.impressions}}</h5>
                                <p class="mt-0 color-gray">impressions</p>
                            </div>
                            <div class="col">
                                <h5 class="mb-0">{{user.conversions}}</h5>
                                <p class="mt-0 color-gray">conversions</p>
                            </div>
                            <div class="col">
                                <h5 class="mb-0">${{user.revenue}}</h5>
                                <p class="mt-0 color-gray">revenue</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <DxSparkline
                                        :data-source="getRevenues(user.id)"
                                        :show-min-max="true"
                                        class="sparkline"
                                        type="line"
                                        :size="size"
                                    >
                                    <DxTooltip format="currency"/>
                                </DxSparkline>
                            </div>
                            <div class="col-md-12">
                                <h5 class="mb-0">Conversions 24/4</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
 import 'devextreme/dist/css/dx.light.css';
import DxSparkline, {
  DxTooltip,
} from 'devextreme-vue/sparkline';
    export default {
        components: {
            DxSparkline,
            DxTooltip,
        },
        data() {
            return {
              usersInfo: [],
              usersRevenue:[],
              size:{
                height:60
              },
              sortBy:[
                "name",
                "impressions",
                "conversions",
                "revenue"
              ]
            }
        },
         created() {
            this.getUserRevenue()
            this.getUserInfo('name')
        },
        methods: {
            getUserRevenue(){
                 axios.get('/api/fetch-users-revenue')
                     .then((response)=>{
                        this.usersRevenue = response.data.usersRevenue
                     })
            },
            getUserInfo(event){
                let sortType = 'name'
                if(typeof event != 'string'){
                    sortType = event.target.value
                }
                axios.get('/api/fetch-users-info?sortBy='+sortType)
                     .then((response)=>{
                        this.usersInfo = response.data.usersInfo
                     })
            },
            getRevenues(id){
                return this.usersRevenue.find(o => o.id == id).revenue.split(',')
            }
        }
    }
</script>
<style scoped>
.image-div{
    height:80px;
    width:80px;
    background-color:#ffcccb;
    border-radius:50%;
    margin: 10px auto;
    position: relative;
    overflow:hidden
}
.color-gray{
    color:gray;
}
.name-first-alpha{
    text-align: center;
    padding-top: 17px;
    font-weight: 600;
}
.custom-form-control{
    height:40px;
    border:1px gray solid;
    border-radius:4px
}
</style>
