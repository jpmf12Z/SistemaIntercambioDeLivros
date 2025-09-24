<?php
/**
 * Autoload para as classes do sistema BookSwap
 * Converte namespace em caminho de arquivo
 */
spl_autoload_register(function ($class) {
    // Namespace base do projeto
    $prefix = 'App\\';

    // Diretório base onde estão as classes
    $base_dir = __DIR__ . '/../';

    // Verifica se a classe usa o namespace esperado
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // não é do namespace App, ignora
        return;
    }

    // Pega a parte da classe sem o prefixo
    $relative_class = substr($class, $len);

    // Converte \ para / e monta o caminho completo
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Inclui o arquivo se ele existir
    if (file_exists($file)) {
        require $file;
    }
});
