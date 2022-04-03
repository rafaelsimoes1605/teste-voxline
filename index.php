<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar CEP</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h2>Pesquisar endereço pelo CEP</h2>
    </header>
    <main>
        <div class="container">
            <form class="j_frm_busca_cep" method="post">
                <label for="cep"><b>Informe o CEP</b>
                    <input type="text" id="cep" placeholder="Ex: 12345-123" name="cep" class="mask_cep j_cep">
                </label>
                <div class="containerbtn">
                    <button type="submit" class="buscarbtn">Pesquisar</button>
                    <button type="reset" class="cancelbtn">Limpar</button>
                </div>
            </form>
            <div class="j_content_cep"></div>
        </div>
    </main>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script src="js.js"></script>

</html>