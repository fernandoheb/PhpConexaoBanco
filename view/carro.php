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
                <div>    
                    <h3 id="placa"> </h3>
                    <h3 id="marca"> </h3>
                    <h3 id="descricao"> </h3>
                </div>    
            </div>
            <script>
                $(document).ready(function () {
                    $('#cod').change(function () {
                        $.ajax({
                            url: '../controller/carroControler.php?Carroid=' + $(this).val(),
                            dataType: 'html',
                            type: 'GET',
                            success: function (data, textStatus) {
                                // var  obj = {'nome':'valor','idade':21};
                                var VetorCarros = jQuery.parseJSON(data);
                                console.log(VetorCarros.length);
                                if (VetorCarros.length > 0) {
                                    carro = VetorCarros[0];
                                    $("#descricao").html(carro.des_car);
                                    $("#placa").html(carro.pla_car);
                                    $("#marca").html(carro.mar_car);
                                            
                                } else {
                                    $("#descricao").html('');
                                    $("#placa").html('');
                                    $("#marca").html('');
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
