$(function() {
    $.instantiatingInputMask();
});

$.instantiatingInputMask = function() {
    try {
        $("[data-mask]").each(function(index) {
            let inputmask = $(this);
            let options = {
                clearIncomplete: false,
                placeholder: "_"
            };
            let op = {};
            switch (inputmask.data("mask")) {
                case "integer":
                    options.allowMinus = false;
                    inputmask.inputmask("integer", options);
                    break;
                case "numeric":
                    options.allowMinus = false;
                    inputmask.inputmask("numeric", options);
                    break;
                case "decimal":
                    op = {
                        radixPoint: ",",
                        groupSeparator: ".",
                        allowMinus: false,
                        prefix: "",
                        digits: 2,
                        digitsOptional: false,
                        rightAlign: true,
                        unmaskAsNumber: true
                    };
                    inputmask.inputmask("decimal", op);
                    break;
                case "phone":
                    options.greedy = false;
                    options.removeMaskOnSubmit = true;
                    inputmask.inputmask("(99) 9999[9]-9999", options);
                    break;
                case "money":
                    inputmask.inputmask("currency", options);
                    break;
                case "real":
                    op = {
                        radixPoint: ",",
                        groupSeparator: ".",
                        allowMinus: false,
                        prefix: "",
                        digits: 2,
                        digitsOptional: false,
                        rightAlign: true,
                        unmaskAsNumber: true
                    };
                    inputmask.inputmask("currency", op);
                    break;
                case "cpf":
                    inputmask.inputmask("999.999.999-99", options);
                    break;
                case "cnpj":
                    inputmask.inputmask("99.999.999/9999-99", options);
                    break;
                case "cpfcnpj":
                    options.keepStatic = true;
                    options.mask = ["999.999.999-99", "99.999.999/9999-99"];
                    inputmask.inputmask(options);
                    break;
                case "cep":
                    inputmask.inputmask("99.999-999", options);
                    break;
                default:
                    console.log(
                        "Tipo de máscara '" +
                            inputmask.data("mask") +
                            "' não implementado!"
                    );
            }
        });
    } catch (e) {
        console.log(e.message);
    }
};
