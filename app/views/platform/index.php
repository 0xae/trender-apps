<?php
$this->title = 'Trender Platform';
?>
 
<div id="app">
    {{ message }}
</div>

<!-- intro -->
<div id="app-2">
  <span v-bind:title="message">
    Hover your mouse over me for a few seconds
    to see my dynamically bound title!
  </span>
</div>

<!-- conditionals -->
<div id="app-3">
  <p v-if="seen">Now you see me</p>
  <p v-if="!seen">Now you dont!</p>
</div>


<!-- loops -->
<div id="app-4">
  <ol>
    <li v-for="todo in todos">
      {{ todo.text }}
    </li>
  </ol>
</div>

<!-- events -->
<div id="app-5">
  <p>{{ message }}</p>
  <button v-on:click="updateData">Reverse Message</button>
</div>

<!-- two way data binding -->
<div id="app-6">
  <p>{{ message }}</p>
  <input v-model="message">
</div>
