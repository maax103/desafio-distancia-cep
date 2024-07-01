<template>
  <form autocomplete="off" @submit.prevent="submitForm" class="border p-3 my-3 rounded">
    <div>
      <h1 class=" display-6 secondary">Inserir um registro novo</h1>
    </div>
    <hr>
    <div class="mb-3">
      <label for="cep1" class="form-label">CEP de origem</label>
      <input required v-model="formData.cep1" class="form-control" id="cep1">
    </div>
    <div class="mb-3">
      <label for="cep2" class="form-label">CEP de destino</label>
      <input required v-model="formData.cep2" class="form-control" id="cep2">
    </div>
    <div class="d-flex gap-3">
      <button type="submit" class="btn btn-primary">
        <template v-if="submitting">
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </template>
        <span class="m-2">Calcular e Salvar </span>
      </button>
      <button @click="closeForm" type="button" class="btn">Cancelar</button>
    </div>
  </form>  
</template>
  
<script>
  export default {
    data() {
      return {
        formData: {
          cep1: '',
          cep2: '',
        },
        submitting: false,
      }
    },
    methods: {
      closeForm() {
        this.$emit('close-form');
      },
      async submitForm() {

        this.submitting = true;

        const API_URL = useRuntimeConfig().public.API_URL;
        try {

          const response = await fetch(API_URL + '/api/distance', {
            method: "POST",
            body: new URLSearchParams(this.formData)
          });
          const response_data = await response.json();
          console.log(response_data);
          this.$emit('submitted', this.formData);
        } catch (err) {
          alert('Ooops, algo de errado ocorreu.')  
        }
        this.submitting = false;
      }
    },
  };
</script>

<style scoped>
/* Adicione estilos específicos para o formulário aqui, se necessário */
</style>
