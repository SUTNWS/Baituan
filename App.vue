<template>
  <div>
  <el-form ref="form" :model="form" label-width="80px">
    <el-form-item label="用户名">
      <el-input v-model="form.name" placeholder="请输入用户名"></el-input>
    </el-form-item>
    <el-form-item label="密码">
      <el-input type="password" v-model="form.password" placeholder="请输入密码"></el-input>
    </el-form-item>
    <el-button type="primary" @click="onSubmit">提交</el-button>
  </el-form>
  </div>
</template>

<script>
    export default {
    data () {
          return {
            form: {
              name:'',
              password:''
            }
          };
        },
    methods:{
      onSubmit(){
        var params = new URLSearchParams()
        params.append('name',this.form.name)
        params.append('password',this.form.password)
        this.$axios.post('http://localhost/test.php',params)
        .then((response) => alert(response.data))
        .catch((response) => alert(response))
      }
    }
  }
</script>

<style>
</style>
