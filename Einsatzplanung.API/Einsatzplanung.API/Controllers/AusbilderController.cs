using System.Web.Http;
using System.Net.Http;
using Einsatzplanung.API.Models;
using System.Net;

namespace Einsatzplanung.API.Controllers
{
    public class AusbilderController : ApiController
    {
        [HttpGet]
        [Route("api/ausbilder/{persNummer}")]
        public int GetAusbilderID([FromUri] int persNummer)
        {

            return 0;
        }
    
        [HttpPost]
        [Route("api/ausbilder")]
        public HttpResponseMessage PostAusbilder([FromBody] Ausbilder ausbilder)
        {

            return Request.CreateResponse(HttpStatusCode.OK);
        }
    }
}