<h2>Tworzenie zestawu - Krok 1</h2>
<h5>Rodzaj gry: Wyścig</h5>

<form id='race1' method="GET" action="kreator/race_ver1.php" class='form-horizontal'>
    <fieldset>

        <input class="hidden" type="text" name="game" id="Game" value="race">

        <h4>Napisz nazwę nowego zestawu:</h4>

        <input type="text" class="form-control" name="name" id="Name" placeholder="Nazwa zestawu">

        <br>

        <h4>Wybierz kategorię z której będą pytania:</h4>
        <select class="form-control" name="subject" id="Subject">
            <option>Język Angielski</option>
            <option>Język Polski</option>
            <option>Matematyka</option>
            <option>Przyroda</option>
        </select>

        <br>

        <h4>Opisz w skrócie swój zestaw pytań:</h4>
        <textarea class="form-control" rows="3" name="descr" id="Descr"></textarea>

        <br>

        <h4>Wybierz ile pytań będzie znajdować się w zestawie:</h4>
        <select class="form-control" name="numb" id="Numb">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
        </select>

        <br><br>
		
        <input class='btn btn-lg btn-success' value='Następny krok' type='submit'>

    </fieldset>
</form><!--form-->