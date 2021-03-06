<!DOCTYPE html>
<html lang="en">

<head>
    <title>Javascript IJS Sandbox </title>
    <link rel="shortcut icon" href="favicon.ico">
    <script type="text/javascript" src="myfunctions.js"></script>
    <script type="text/javascript" src="ijs.js"></script>
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <form name="theForm">
            <h2>SONAR</h2>
            <input id='mode' type="text" readonly name="mode" size=9 value="Command" onClick="setmode(-1)">

            <h2>JavaScript Console</h2>

            <textarea name="input" rows=25 cols=68 onKeyUp="enter(event)"></textarea>

        </form>

        <script>
            // Sonar - converted from Sonar.py
            // from the 2nd edition of 'Invent Your Own Computer Games with Python'
            // by Albert Sweigart
            function drawBoard(board) {
                // Draw the board data structure
                cls()
                hline = '    ' // initial space for the numbers down the left side of the board
                for (var i = 1; i < 6; i++) hline += '         ' + i
                // print the numbers across the top
                print(hline)
                print('   ' + ('012345678901234567890123456789012345678901234567890123456789'))
                print()
                // print each of the 15 rows
                for (var i = 0; i < 15; i++) {
                    // single-digit numbers need to be padded with an extra space
                    if (i < 10) XSpace = ' ';
                    else XSpace = ''
                    print('' + XSpace + '' + i + ' ' + getRow(board, i) + ' ' + i)
                }
                // print the numbers across the bottom
                print()
                print('   ' + ('012345678901234567890123456789012345678901234567890123456789'))
                print(hline)
            }

            function getRow(board, row) {
                // return a string from the board data structure at a certain row
                boardRow = ''
                for (var i = 0; i < 60; i++) boardRow += board[i][row]
                return boardRow
            }

            function getNewBoard() {
                // create a new 60 x 15 board data structure
                board = []
                for (var x = 0; x < 60; x++) { // the main list is a list of 60 lists
                    board.push([])
                    for (var y = 0; y < 15; y++) {
                        // each list in the main list has 15 single-character strings
                        // use different characters for the ocean to make it more readable
                        if (rand(0, 1) == 0) board[x].push('~')
                        else board[x].push('`')
                    }
                }
                return board
            }

            function getRandomChests(numChests) {
                // create a list of chest data structures
                // two-item lists of x, ycoordinates
                chests = []
                for (var i = 0; i < numChests; i++) {
                    chests.push([rand(0, 59), rand(0, 14)])
                }
                return chests
            }

            function isValidMove(x, y) {
                // return true if (the coordinates are on the board, otherwise false
                return x >= 0 && x <= 59 && y >= 0 && y <= 14
            }

            function makeMove(board, chests, x, y) {
                // Return -1 if this is an invalid move
                // Remove treasure chests from the list as they are found. 
                // Otherwise, return the result of this move.
                if (!isValidMove(x, y)) {
                    return -1
                }
                smallestDistance = 100 //any chest will be closer than 100
                ci = -1
                for (var i = 0; i < chests.length; i++) {
                    cx = chests[i][0];
                    cy = chests[i][1]
                    if (Math.abs(cx - x) > Math.abs(cy - y)) distance = Math.abs(cx - x)
                    else distance = Math.abs(cy - y)
                    if (distance < smallestDistance) {
                        // we want the closest treasure chest
                        ci = i;
                        smallestDistance = distance
                    }
                }
                if (smallestDistance == 0) {
                    // xy is directly on a treasure chest!
                    board[x][y] = '$';
                    copyOfBoard[x][y] = '$';
                    chests = chests.splice(ci, 1)
                    return 0
                } else if (smallestDistance < 10) {
                    board[x][y] = (smallestDistance)
                    x1 = x - smallestDistance;
                    y1 = y - smallestDistance;
                    sd2 = 2 * smallestDistance + 1
                    x2 = x1 + sd2 - 1;
                    y2 = y1 + sd2 - 1
                    if (showHints)
                        for (i = 0; i < sd2; i++) {
                            writeHint(x1 + i, y1);
                            writeHint(x1, y1 + i);
                            writeHint(x1 + i, y2);
                            writeHint(x2, y1 + i)
                        }
                    return 'Treasure detected at a distance of ' + smallestDistance + ' from the sonar device.'
                } else {
                    if (board[x][y] != '$') board[x][y] = 'O'
                    return 'Sonar did not detect anything. All treasure chests out of range'
                }
            }

            function writeHint(x, y) {
                if (x >= 0 && x <= 59 && y >= 0 && y <= 14) board[x][y] = '+'
            }

            function enterPlayerMove() {
                // let the player type in a move. Return a two-item list of int xy coordinates
                print('Where do you want to drop the next sonar device? (1-59,0-14) (or type quit)')
                while (true) {
                    move = input()
                    if (move.toLowerCase().charAt(0) == 'q') {
                        print('Thanks for playing!');
                        return []
                    }
                    if (move.toLowerCase().charAt(0) == 'h') {
                        showHints = !showHints
                        for (i = 0; i < previousMoves.length; i++) {
                            makeMove(theBoard, theChests, previousMoves[i][0], previousMoves[i][1])
                        }
                        drawBoard(theBoard);
                        continue
                    }
                    move = move.split(',')
                    if (move.length == 2 && !isNaN(move[0]) && !isNaN(move[1]) && isValidMove(move[0], move[1])) {
                        return [int(move[0]), int(move[1])]
                    }
                    print('Enter a number from 0 to 59, a comma, then a number from 0 to 14')
                }
            }

            function playAgain() {
                // This function returns true if (the player wants to play again, otherwise it returns false
                return input('Do you want to play again? (yes or no)').toLowerCase().charAt(0) == 'y'
            }

            function showInstructions() {
                print('Instructions: You are the captain of the Simon, a treasure-hunting ship. Your current mission\nis to find the three sunken treasure chests that are lurking in the part of the\nocean you are in, and collect them.\n\nTo play, enter the coordinates of the point in the ocean you wish to drop a\nsonar device. The sonar can find out how far away the closest chest is to it.\nFor example, the d below marks where the device was dropped, and the 2\'s\nrepresent distances of 2 away from the device. The 4\'s represent\ndistances of 4 away from the device.\n\n  444444444\n  4       4\n  4 22222 4\n  4 2   2 4\n  4 2 d 2 4\n  4 2   2 4\n  4 22222 4\n  4       4\n  444444444\nPress enter to continue...')
                input();
                cls()
                print('For example, here is a treasure chest (the c) located a distance of 2 away\nfrom the sonar device (the d)) {\n\n  22222\n  2   2\n  2 d 2\n  2   2\n  22222\n\nThe point where the device was dropped will be marked with a s.\n\nThe treasure chests don\'t move around. Sonar devices can detect treasure\nchests up to a distance of 9. If all the chests are out of range, the point\nwill be marked with O\n\nIf a device is directly dropped on a treasure chest, you have discovered\nthe location of the chest, and it will be collected. The sonar device will\nremain there.\n\nWhen you collect a chest, all sonar devices will update to locate the next\nclosest sunken treasure chest.\nPress enter to continue...')
                input();
                cls()
            }
            //---------------------*/
            showHints = false
            print('S O N A R !');
            print()
            if (input('Would you like to view the instructions? (yes/no)').toLowerCase().charAt(0) == 'y') showInstructions()
            while (true) {
                // game setup
                sonarDevices = 16
                theBoard = getNewBoard()
                copyOfBoard = [] // make a copy
                for (i = 0; i < theBoard.length; i++) {
                    copyOfBoard[i] = []
                    for (j = 0; j < theBoard[i].length; j++) copyOfBoard[i][j] = theBoard[i][j]
                }
                theChests = getRandomChests(3)
                previousMoves = []
                while (sonarDevices > 0) {
                    // Start of a turn:  show sonar device/chest status
                    drawBoard(theBoard)
                    if (sonarDevices > 1) {
                        XSsonar = 's'
                    } else {
                        XSsonar = ''
                    }
                    if (theChests.length > 1) {
                        XSchest = 's'
                    } else {
                        XSchest = ''
                    }
                    print(theChests)
                    print('You have ' + sonarDevices + ' sonar device' + XSsonar + ' left. ' + theChests.length + ' treasure chest' + XSchest + ' remaining.')
                    z = enterPlayerMove()
                    if (z.length == 0) break
                    x = z[0];
                    y = z[1]
                    previousMoves.push(z) // we must track all moves so that sonar devices can be updated
                    moveResult = makeMove(theBoard, theChests, x, y)
                    if (moveResult < 0) continue
                    else if (moveResult == 0) {
                        moveResult = 'Congratulations! you got one.'
                        for (i = 0; i < theBoard.length; i++) {
                            for (j = 0; j < theBoard[i].length; j++) theBoard[i][j] = copyOfBoard[i][j]
                        }
                        // update all the sonar devices currently on the map.
                        for (i = 0; i < previousMoves.length; i++) {
                            makeMove(theBoard, theChests, previousMoves[i][0], previousMoves[i][1])
                        }
                    }
                    if (theChests.length == 0) {
                        print('You have found all the sunken treasure chests!');
                        break
                    }
                    sonarDevices -= 1
                }
                if (sonarDevices == 0) {
                    print('We\'ve run out of sonar devices! Now we have to turn the ship around and head')
                    print('for home with treasure chests still out there! Game over.')
                }
                if (theChests.length > 0) {
                    print('The remaining chests were here:', '')
                    for (i = 0; i < theChests.length; i++)
                        print('(' + theChests[i][0], theChests[i][1] + ')   ', '')
                    print()
                }
                if (!playAgain()) break
            }
            //
        </script>
    </div>
</body>

</html>