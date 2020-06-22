$(document).ready(function() {
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
                case "input-daterange input":
                    inputmask.inputmask("date", options);
                    break;
                case "expiration_date":
                    inputmask.inputmask("mm/yyyy", options);
                    break;
                case "date":
                    inputmask.inputmask("date", options);
                    break;
                case "time":
                    inputmask.inputmask("hh:mm:ss", options);
                    break;
                case "email":
                    inputmask.inputmask("email", options);
                    break;
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
                    //options.removeMaskOnSubmit = true;
                    inputmask.inputmask("999.999.999-99", options);
                    break;
                case "cnpj":
                    options.removeMaskOnSubmit = true;
                    inputmask.inputmask("99.999.999/9999-99", options);
                    break;
                case "cpfcnpj":
                    options.keepStatic = true;
                    options.removeMaskOnSubmit = true;
                    options.mask = ["999.999.999-99", "99.999.999/9999-99"];
                    inputmask.inputmask(options);
                    break;
                case "cep-palmas":
                    options.removeMaskOnSubmit = true;
                    inputmask.inputmask("99.999-999", options);
                    break;
                case "uf":
                    inputmask.inputmask("AA", options);
                    break;
                case "weight":
                    inputmask.inputmask("*{1,3}[.*{1,2}]|[.00]|[.90]", options);
                    break;
                case "stature":
                    inputmask.inputmask("999", options);
                    break;
                case "agency":
                    options.rightAlign = true;
                    options.greedy = false;
                    inputmask.inputmask("9999[-9]", options);
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
