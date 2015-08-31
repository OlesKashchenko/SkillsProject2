<div class="result_block one_colum">
    <div class="result_item" id="results-table-{{ $identifier }}">
        <!--<div class="result_item_header">
            <h2># {{ $identifier }}</h2>
            <a class="remove" onclick="App.removeTTN('{{ $identifier }}');"></a>
        </div>!-->
        <div class="result_item_body">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <h2># {{ $identifier }}</h2>
                        </td>
                        <td><a class="remove" onclick="App.removeTTN('{{ $identifier }}');"></a></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>К сожалению, поиск не дал результатов. Возможно, Вы ввели неверные данные...</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>    