$(document).ready(() => {

    //  All Varibales here

    let completeBtn = document.getElementById('completeBtn');
    let clearCompleteBtn = document.getElementById('clearCompleteBtn');
    let allBtn = document.getElementById('allBtn');
    let completedTbl = document.getElementById('completedTbl');
    let allTbl = document.getElementById('allTbl');
    let alltblbody = document.getElementById('alltblbody');
    let completedtblbody = document.getElementById('completedtblbody');

    //  Complete button click event
    $(document).on('click', '#completeBtn', (e) => {
        e.preventDefault();
        allTbl.classList.add('aun-hide-it');
        completedTbl.classList.remove('aun-hide-it');
    });

    //  All button click event
    $(document).on('click', '#allBtn', (e) => {
        e.preventDefault();
        allTbl.classList.remove('aun-hide-it');
        completedTbl.classList.add('aun-hide-it');
    });

    //  check box click event to change the text color
    $(document).on('change', 'input[name=todo]', (e) => {
        let isChecked = e.target.checked;
        let todoText = e.target.parentElement.childNodes[3].childNodes[0];
        if (isChecked) {
            todoText.classList.remove("black-text")
            todoText.classList.add("aun-strik", "grey-text");
        } else {
            todoText.classList.remove("aun-strik", "grey-text");
            todoText.classList.add("black-text");
        }

    });

    //  Dubble click event to make todo editable
    $(document).on('dblclick', '.aun-editable', (e) => {
        e.target.parentElement.parentElement.parentElement.parentElement.childNodes[1].classList.add('aun-hide-it');
        e.target.parentElement.parentElement.parentElement.parentElement.childNodes[3].classList.remove('aun-hide-it', 'hide-on-med-and-down');
    });

    //  after editing todo the enter key press event handeler
    $(document).on('keypress', '.edited-input', (e) => {
        if (e.which == 13) {
            let textAfterEdited = e.target.value;
            let check = Aun_AjaxGetRequest('todoEdit', e.target.dataset.databaseid, textAfterEdited, null);
            check.then(data => {
                console.log(data);
                e.target.parentElement.parentElement.childNodes[1].childNodes[1].childNodes[3].childNodes[0].innerHTML = textAfterEdited;
                e.target.parentElement.parentElement.childNodes[3].classList.add('aun-hide-it', 'hide-on-med-and-down');
                e.target.parentElement.parentElement.childNodes[1].classList.remove('aun-hide-it');
            }).catch(data => {
                console.log(data.status);
            });
        }
    });

    //  New todo form submit handeler
    $(document).on('submit', '#todoForm', (e) => {
        e.preventDefault();
        let inputvalue = $('#newTodo').val();
        let form = $('#todoForm');

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: data => {
                if (data != "server-500") {
                    let view = `
                                <tr>
                                    <td class="">
                                    <p>
                                        <input type="checkbox" name="todo" id="${data}" class="aun-editable" data-databaseid="${data}" data-databasevalue="${inputvalue}">
                                        <label for="${data}"><span class="black-text lighten-4 aun-editable todovalue">${inputvalue}</span></label>
                                    </p>
                                    </td>
                                    <td class="aun-hide-it">
                                        <input type="text"placeholder="Edit Here" value="${inputvalue}" class="edited-input" data-databaseid="${data}" data-databasevalue="${inputvalue}">
                                    </td>
                                    <td class=""><a class="recentTodoClose" data-databaseid="${data}" href="#"><i class="material-icons right red-text" data-databaseid="${data}">close</i></a></td>
                                </tr>

                                `;
                    if (inputvalue != '') {
                        alltblbody.innerHTML += view;
                    }
                    countItemLeft();
                    document.getElementById('todoForm').reset();
                }
            },
            error: data => {
                console.log("ERROR");
                console.log(data);
            }
        });
    });

    //  all todo incomplete todo close button click handeler
    $(document).on('click', '.recentTodoClose', (e) => {
        e.preventDefault();
        let check = Aun_AjaxGetRequest('singleTodoDelete', e.target.dataset.databaseid, null, null);
        check.then(data => {
            console.log(data);
            if (data == 1) {
                e.target.parentElement.parentElement.parentElement.remove();
                countItemLeft();
            }
        }).catch(data => {
            console.log(data.status);
        });
    });

    //  Completed todo close button click handeler
    $(document).on('click', '.completeTodoClose', e => {
        e.preventDefault();
        let check = Aun_AjaxGetRequest('singleTodoDelete', e.target.dataset.databaseid, null, null);
        check.then(data => {
            console.log(data);
            if (data == 1) {
                e.target.parentElement.parentElement.parentElement.remove();
                countItemLeft();
            }
        }).catch(data => {
            console.log(data.status);
        });
    });

    //  Clear Completed Button Click Event handeler
    $(document).on('click', '#clearCompleteBtn', e => {
        e.preventDefault();
        let check = Aun_AjaxGetRequest('clearAllCompleted', null, null, null);
        check.then(data => {
            console.log(data);
            completedtblbody.innerHTML = '';
            countItemLeft();
        }).catch(data => {
            console.log(data.status);
        });
    });

    //  Active todo button click event handeler
    $(document).on('click', '#activeBtn', (e) => {
        e.preventDefault();
        let allCheckBox = document.querySelectorAll('#alltblbody tr input[name=todo]');
        let alltr = document.querySelectorAll('#alltblbody tr');
        let allvalue = document.querySelectorAll('#alltblbody tr .todovalue');
        allCheckBox.forEach((item, index) => {
            if (item.checked) {
                let fromDataaseId = item.dataset.databaseid;
                let fromDataaseValue = allvalue[index].innerHTML;

                let check = Aun_AjaxGetRequest('todoComplete', fromDataaseId, 1, null);
                check.then(data => {
                    console.log(data);
                    let view = `
                                <tr>
                                    <td>
                                    <h5 class="grey-text aun-strik" data-databaseid="${fromDataaseId}">${fromDataaseValue}</h5>
                                    </td>
                                    <td class=""><a class="recentTodoClose" data-databaseid="${fromDataaseId}" href="#"><i class="material-icons right red-text" data-databaseid="${fromDataaseId}">close</i></a></td>
                                </tr>
                                `;
                    completedtblbody.innerHTML += view;
                    alltr[index].remove();
                    countItemLeft();
                }).catch(data => {
                    console.log(data.status);
                });
            }
        });
    });
    countItemLeft();

    // My Custom Js ends here
});

//  Counting and showing the item left and functioning the clear completed button visiblity
function countItemLeft() {
    let alltr = document.querySelectorAll('#alltblbody tr').length;
    $('#itemleft').html(alltr);
    let completedTr = document.querySelectorAll('#completedtblbody tr').length;

    if (completedTr == 0) {
        clearCompleteBtn.classList.add('grey-text');
        clearCompleteBtn.classList.remove('black-text');
    } else {
        clearCompleteBtn.classList.remove('grey-text');
        clearCompleteBtn.classList.add('black-text');
    }

    if (alltr == 0 && completedTr == 0) {
        document.getElementById('card-action').classList.add('aun-hide-it');
    } else {
        document.getElementById('card-action').classList.remove('aun-hide-it');
    }
}

//  AJAX Get Request Function
function Aun_AjaxGetRequest(actionType, databaseId, largeText, collection) {
    return $.ajax({
        type: "GET",
        url: "get-cls.php",
        data: {
            actionType: actionType,
            databaseId: databaseId,
            largeText: largeText,
            collection: collection,
        },
    });
}