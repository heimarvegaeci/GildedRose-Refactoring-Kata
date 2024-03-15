import unittest
from gilded_rose import GildedRose, Item

class GildedRoseTest(unittest.TestCase):

    def test_update_quality(self):
        items = [Item("Normal Item", 10, 20)]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(items[0].sell_in, 9)
        self.assertEqual(items[0].quality, 19)

    def test_update_aged_brie(self):
        items = [Item("Aged Brie", 5, 10)]
        gilded_rose = GildedRose(items)
        gilded_rose.update_aged_brie(items[0])
        self.assertEqual(items[0].sell_in, 4)
        self.assertEqual(items[0].quality, 11)

    def test_update_backstage_passes(self):
        items = [Item("Backstage Passes", 15, 20)]
        gilded_rose = GildedRose(items)
        gilded_rose.update_backstage_passes(items[0])
        self.assertEqual(items[0].sell_in, 14)
        self.assertEqual(items[0].quality, 21)

    def test_update_normal_item(self):
        items = [Item("Normal Item", 3, 6)]
        gilded_rose = GildedRose(items)
        gilded_rose.update_normal_item(items[0])
        self.assertEqual(items[0].sell_in, 2)
        self.assertEqual(items[0].quality, 5)

if __name__ == '__main__':
    unittest.main()
