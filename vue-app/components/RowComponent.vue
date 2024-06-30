<template>
  <tr>
    <td>{{ item.id }}</td>
    <td>{{ item.cep1 }}</td>
    <td>{{ item.cep2 }}</td>
    <td>{{ 0 }}</td>
  </tr>
</template>

<script>
  export default {
    props: {
        item: {
            type: Object,
            required: true,
        }
    }
  }
</script>