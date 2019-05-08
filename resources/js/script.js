/*AdminPanel Sidebar toggle*/
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
/*Image upload display instantly after selected image in 'input type file' on form*/
function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#profile-img-tag')
              .attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
  }
}
/*Ref : dev.to - Eder Diaz
/*All posts display zoom animation on hover*/
  new Vue({
    el: '#app',
    data: {
      cards: [
        {title: 'Gooey PBJ Brownies', author: 'John Walibur', image: 'https://placeimg.com/640/480/nature'},
        {title: 'Crisp Spanish Tortilla Matzo Brei', author: 'Colman Andrews', image: 'https://placeimg.com/640/480/animals'},
        {title: 'Grilled Shrimp with Lemon and Garlic', author: 'Celeste Mills', image: 'https://placeimg.com/640/480/arch'}
      ],
      selectedCard: -1
    },
    methods: {
        hoverCard(selectedIndex) {
          this.selectedCard = selectedIndex
          this.animateCards()
        },
        isSelected (cardIndex) {
          return this.selectedCard === cardIndex
        },
        animateCards () {
            this.cards.forEach((card, index) => {
              const direction = this.calculateCardDirection(index, this.selectedCard)
              TweenMax.to(
                this.$refs[`card_${index}`],
                0.3,
                {x: direction * 50}
              )
            })
          },
          calculateCardDirection (cardIndex, selectedIndex) {
            if(selectedIndex === -1) {
              return 0
            }

            const diff = cardIndex - selectedIndex
            return diff === 0 ? 0 : diff/Math.abs(diff)
          },
      }
  })
