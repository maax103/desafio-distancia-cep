<template>
  <tr>
    <td>{{ item.id }}</td>
    <td>{{ item.cep1 }}</td>
    <td>{{ item.cep2 }}</td>
    <td>{{ 0 }}</td>
    <td>{{ '29/06/2024 21:20' }}</td>
    <td>{{ '29/06/2024 21:20' }}</td>
    <td>+</td>
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