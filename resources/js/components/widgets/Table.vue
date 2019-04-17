<template>
  <v-data-table
    :headers="headers"
    :items="items"
    class="elevation-1"
  >
    <v-slot></v-slot>
    <!--<template v-slot:items="props">-->
      <!--<td>{{ props.item.name }}</td>-->
      <!--<td class="text-xs-right">{{ props.item.calories }}</td>-->
      <!--<td class="text-xs-right">{{ props.item.fat }}</td>-->
      <!--<td class="text-xs-right">{{ props.item.carbs }}</td>-->
      <!--<td class="text-xs-right">{{ props.item.protein }}</td>-->
      <!--<td class="text-xs-right">{{ props.item.iron }}</td>-->
    <!--</template>-->
  </v-data-table>
</template>

<script>
  export default {
    props: {
      headers: Array,
      items: Array,
    }
  }
</script>
