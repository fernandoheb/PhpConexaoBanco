<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> Página de exemplo </title>
        <?php include '../config/cabecalho.php'; ?> 
    </head>
    <body>
        <div class='container' > 
        <form action="javascript:void%200"  >
            <label for='cod' class='text-light'> Código carro: </label>
            <input type="number" class="form-control" id="cod" name="cod">             
        </form>
        <div class=' mt-1 rounded bg-light' >
        <div id="resultado"> </div>
        </div>    
        </div>
        <script>

            $(document).ready(function () {
                $('#cod').change(function () {
                    $.ajax({
                        url: '../controller/carroControler.php?id=' + $(this).val(),
                        dataType: 'html',
                        type: 'GET',
                        success: function (data, textStatus) {
                           // var  obj = {'nome':'valor','idade':21};
                            var carro = jQuery.parseJSON(data);                          
                            console.log(carro.length); 
                            if (carro.length > 0) {
                                carro = carro[0];
                                $("#resultado").html('<h2>' + carro.pla_car + '</h2>'
                                                    +'<h2>' + carro.mar_car + '</h2>'
                                                    +'<h3>' + carro.des_car + '</h3>');
                            } else {
                                $("#resultado").html('');
                            }
                        },
                        error: function (xhr, er) {
                            $('#resultdo').html('<p class="bg-danger p-5 text-center">Erro ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er + '</p>');
                        }
                    });
                });


            });





        </script>


    </body>
</html>
