
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace Einsatzplanung.API.Models
{
    [Table("abteilungen")]
    public class Abteilung
    {
        [Key]
        [Column("abteilungID")]
        public int AbteilungID { get; set; }

        [Column("koe")]
        public string KOE { get; set; }

        [Column("beschreibung")]
        public string Beschreibung { get; set; }

        [Column("stellen")]
        public int Stellen { get; set; }
    }

}
