export const TicTacToe = {
  el: null,
  boxes: null,
  onMove: null,

  isGameEnd: false,
  isXTurn: true,

  matrix: [
    [null, null, null],
    [null, null, null],
    [null, null, null],
  ],

  wonCombinations: [
    [[1,1],[1,2],[1,3]],
    [[2,1],[2,2],[2,3]],
    [[3,1],[3,2],[3,3]],
    [[1,1],[2,1],[3,1]],
    [[1,2],[2,2],[3,2]],
    [[1,3],[2,3],[3,3]],
    [[1,1],[2,2],[3,3]],
    [[1,3],[2,2],[3,1]],
  ],

  init({ el, onMove }) {
    this.el = el
    this.onMove = onMove
    this.boxes = el.querySelectorAll('.tic-tac-toe__ceil')
    this.initListeners()
    return this
  },

  initListeners() {
    this.boxes.forEach(box => {
      box.onclick = () => {
        if (this.isGameEnd || !this.isBlockEmpty(box)) return

        this.setBlockValue(box)
        this.setBlockDom(box)

        const winCombo = this.checkForWin()
        if (winCombo) {
          this.highlightWin(winCombo)
          this.setGameEndStatus()
          setTimeout(() => alert(`Победил ${this.getCurrentTurnValue()}`), 50)
          return
        }

        if (!this.checkHasEmptyBlocks()) {
          this.setGameEndStatus()
          setTimeout(() => alert('Ничья!'), 50)
          return
        }

        this.changeTurnValue()
        this.onMove?.(this.isXTurn)
      }
    })
  },

  startGame() {
    this.onMove?.(this.isXTurn)
  },

  restartGame() {
    this.isGameEnd = false
    this.isXTurn = true

    this.matrix = [
      [null, null, null],
      [null, null, null],
      [null, null, null],
    ]

    this.boxes.forEach(box => {
      box.innerText = ''
      box.classList.remove('win')
    })

    this.onMove?.(this.isXTurn)
  },

  isBlockEmpty(target) {
    const [r, c] = this.getBlockPosition(target)
    return this.matrix[r - 1][c - 1] === null
  },

  getBlockPosition(target) {
    return [Number(target.dataset.row), Number(target.dataset.col)]
  },

  setBlockValue(target) {
    const [r, c] = this.getBlockPosition(target)
    this.matrix[r - 1][c - 1] = this.getCurrentTurnValue()
  },

  setBlockDom(target) {
    target.innerText = this.getCurrentTurnValue()
  },

  getCurrentTurnValue() {
    return this.isXTurn ? 'X' : 'O'
  },

  changeTurnValue() {
    this.isXTurn = !this.isXTurn
  },

  checkHasEmptyBlocks() {
    return this.matrix.some(row => row.includes(null))
  },

  checkForWin() {
    for (const combo of this.wonCombinations) {
      const [a,b,c] = combo
      const v1 = this.matrix[a[0]-1][a[1]-1]
      const v2 = this.matrix[b[0]-1][b[1]-1]
      const v3 = this.matrix[c[0]-1][c[1]-1]

      if (v1 && v1 === v2 && v2 === v3) {
        return combo
      }
    }
    return null
  },

  highlightWin(combo) {
    combo.forEach(([r, c]) => {
      const cell = this.el.querySelector(
        `.tic-tac-toe__ceil[data-row="${r}"][data-col="${c}"]`
      )
      cell.classList.add('win')
    })
  },

  setGameEndStatus() {
    this.isGameEnd = true
  }
}
