<?php
# Programa Aplicativo (PA) em PHP que recebe e exibe
# os dados dos campos do formulário que 'aciona' o PA.
# Até a versão 4.7 existiam (e existem) os vetores que recebem
# Dados dos campos dos forms:
# $_POST[] - para o método POST
# $_GET[] - para o método GET
# Depois (inclusive)) da versão 4.7 passou a existir
# $_REQUEST[] - para ambos os métodos
# Iniciando uma página HTML (direcionada da camada CGI para o HTTP
printf("<html>\n<body>\n");
printf("<pre>\n");
print_r($_REQUEST);
printf("</pre>\n");
printf("<body>\n<html>\n");



?>